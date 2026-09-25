<?php

namespace App\Services\School;

use App\Models\School\Attendance;
use App\Models\School\Classes;
use App\Models\School\Month;
use App\Models\School\Student;
use App\Models\School\StudentClass;
use App\Models\School\Year;
use Carbon\Carbon;

/**
 * Attendance report: optional class / date / range / month.
 * Counts one mark per student + class + date + session (subjects are merged).
 *
 * Only students who have rows in `attendances` are returned (no empty enroll padding).
 *
 * Short customize map (see docs/attendance-report.md):
 *   statusOf()     — present / late / permission / absent rules
 *   sessionQuery() — add extra filters (teacher, approved, …)
 *   resolveDates() — change date / month / year logic
 *
 * CLI: php artisan attendance:report --class=12 --date=2026-09-24
 */
class AttendanceReportService
{
    public function run(array $filters, $branchId = null, $curId = null, $yearId = null): array
    {
        [$dateFrom, $dateTo] = $this->resolveDates($filters, $yearId);

        $sessions = $this->sessionQuery($filters, $dateFrom, $dateTo, $branchId, $curId)
            ->get();

        $summary = self::emptyCounts();
        $byStudentClass = [];
        $absentEvents = [];
        $permissionEvents = [];

        foreach ($sessions as $row) {
            $status = self::statusOf(
                (bool) $row->is_permission,
                (bool) $row->is_late,
                (bool) $row->is_present
            );
            self::bump($summary, $status);

            $sid = (int) $row->student_id;
            $classId = (int) $row->class_id;
            // Keep Class A + Class B separate when no class filter
            $key = $sid . '_' . $classId;

            if (!isset($byStudentClass[$key])) {
                $byStudentClass[$key] = [
                    'student_id' => $sid,
                    'class_id'   => $classId,
                    ...self::emptyCounts(),
                ];
            }
            self::bump($byStudentClass[$key], $status);

            $event = [
                'student_id' => $sid,
                'class_id'   => $classId,
                'date'       => Carbon::parse($row->date)->format('Y-m-d'),
                'session'    => $row->session,
            ];

            if ($status === 'absent') {
                $absentEvents[] = $event;
            } elseif ($status === 'permission') {
                $permissionEvents[] = $event;
            }
        }

        return [
            'date_from'           => $dateFrom,
            'date_to'             => $dateTo,
            'summary'             => $summary,
            // Only students that exist in attendances for this range
            'students'            => $this->studentRows($byStudentClass, $filters['class_id'] ?? null),
            'students_absent'     => $this->enrichStatusEvents($absentEvents),
            'students_permission' => $this->enrichStatusEvents($permissionEvents),
        ];
    }

    /** permission → late → absent → present */
    public static function statusOf(bool $isPermission, bool $isLate, bool $isPresent): string
    {
        if ($isPermission) {
            return 'permission';
        }
        if ($isLate) {
            return 'late';
        }
        if (!$isPresent) {
            return 'absent';
        }

        return 'present';
    }

    public static function emptyCounts(): array
    {
        return [
            'present'    => 0,
            'late'       => 0,
            'permission' => 0,
            'absent'     => 0,
            'total'      => 0,
        ];
    }

    public static function bump(array &$counts, string $status): void
    {
        if (!isset($counts[$status])) {
            return;
        }
        $counts[$status]++;
        $counts['total']++;
    }

    /**
     * date > range > month_id + year > current month.
     *
     * @return array{0:string,1:string}
     */
    public function resolveDates(array $filters, $yearId = null): array
    {
        if (!empty($filters['date'])) {
            $day = $this->parseDate($filters['date']);

            return [$day, $day];
        }

        if (!empty($filters['date_from']) || !empty($filters['date_to'])) {
            $from = $this->parseDate($filters['date_from'] ?? $filters['date_to']);
            $to = $this->parseDate($filters['date_to'] ?? $filters['date_from']);

            if ($from > $to) {
                [$from, $to] = [$to, $from];
            }

            return [$from, $to];
        }

        if (!empty($filters['month_id'])) {
            return $this->monthRange((int) $filters['month_id'], $yearId);
        }

        $now = Carbon::now();

        return [$now->copy()->startOfMonth()->format('Y-m-d'), $now->format('Y-m-d')];
    }

    /** Accept Y-m-d, d-m-Y, d/m/Y, … */
    private function parseDate(mixed $value): string
    {
        $raw = trim((string) $value);

        foreach (['Y-m-d', 'd-m-Y', 'd/m/Y', 'Y/m/d'] as $format) {
            try {
                $parsed = Carbon::createFromFormat('!' . $format, $raw);
                // Reject overflow dates (e.g. 32-01-2026 → rolls over)
                if ($parsed && $parsed->format($format) === $raw) {
                    return $parsed->format('Y-m-d');
                }
            } catch (\Throwable) {
                // try next format
            }
        }

        return Carbon::parse($raw)->format('Y-m-d');
    }

    /**
     * One row per student + class + date + session.
     * Scope by class branch/curriculum (not only attendances.cur_id) so older
     * rows with null cur_id/branch_id still appear in a date range.
     */
    private function sessionQuery(array $filters, string $dateFrom, string $dateTo, $branchId, $curId)
    {
        return Attendance::query()
            ->from('attendances')
            ->selectRaw('
                attendances.student_id,
                attendances.class_id,
                attendances.date,
                attendances.session,
                MAX(CASE WHEN attendances.is_permission = 1 THEN 1 ELSE 0 END) as is_permission,
                MAX(CASE WHEN attendances.is_late = 1 THEN 1 ELSE 0 END) as is_late,
                MIN(CASE WHEN attendances.is_present = 1 THEN 1 ELSE 0 END) as is_present
            ')
            ->when($branchId && $branchId !== '*', function ($q) use ($branchId) {
                $q->where(function ($inner) use ($branchId) {
                    $inner->where('attendances.branch_id', $branchId)
                        ->orWhere(function ($q) use ($branchId) {
                            $q->whereNull('attendances.branch_id')
                                ->whereHas('class', fn ($c) => $c->where('branch_id', $branchId));
                        });
                });
            })
            ->when($curId && $curId !== '*', function ($q) use ($curId) {
                $q->where(function ($inner) use ($curId) {
                    $inner->where('attendances.cur_id', $curId)
                        ->orWhere(function ($q) use ($curId) {
                            $q->whereNull('attendances.cur_id')
                                ->whereHas('class.grade', fn ($g) => $g->where('cur_id', $curId));
                        });
                });
            })
            ->when(!empty($filters['class_id']), fn ($q) => $q->where('attendances.class_id', $filters['class_id']))
            ->when(!empty($filters['student_id']), fn ($q) => $q->where('attendances.student_id', $filters['student_id']))
            ->when(!empty($filters['subject_id']), fn ($q) => $q->where('attendances.subject_id', $filters['subject_id']))
            ->when(!empty($filters['session']), fn ($q) => $q->where('attendances.session', $filters['session']))
            ->whereDate('attendances.date', '>=', $dateFrom)
            ->whereDate('attendances.date', '<=', $dateTo)
            ->groupBy(
                'attendances.student_id',
                'attendances.class_id',
                'attendances.date',
                'attendances.session'
            );
    }

    /**
     * Map months.id → date range inside the selected school year (X-Year-Id).
     * Example: year start 2026-01-01 + January → 2026-01-01 … 2026-01-31
     */
    private function monthRange(int $monthId, $yearId): array
    {
        $month = Month::findOrFail($monthId);
        $monthNum = Carbon::parse($month->name_en)->month;

        $year = $yearId ? Year::query()->find($yearId) : null;
        $start = $year?->start_date
            ? Carbon::parse($year->start_date)
            : Carbon::now()->startOfYear();
        $end = $year?->end_date
            ? Carbon::parse($year->end_date)
            : Carbon::now()->endOfYear();

        // Same calendar year as academic start, unless that month is before start
        // (e.g. school year Sep 2026–Aug 2027 → January falls in 2027).
        $cursor = $start->copy()->month($monthNum)->startOfMonth();
        if ($cursor->lt($start->copy()->startOfMonth())) {
            $cursor->addYear();
        }

        return [
            $cursor->format('Y-m-d'),
            $cursor->copy()->endOfMonth()->min($end)->format('Y-m-d'),
        ];
    }

    /**
     * Build student rows from attendance only (no empty enrolled padding).
     *
     * @param  array<string, array<string, mixed>>  $byStudentClass
     */
    private function studentRows(array $byStudentClass, $classId): array
    {
        if ($byStudentClass === []) {
            return [];
        }

        $studentIds = collect($byStudentClass)->pluck('student_id')->unique()->filter()->all();
        $classIds = collect($byStudentClass)->pluck('class_id')->unique()->filter()->all();

        $students = Student::query()
            ->whereIn('id', $studentIds)
            ->get(['id', 'name_en', 'name_kh', 'gender'])
            ->keyBy('id');

        $classes = Classes::query()
            ->whereIn('id', $classIds)
            ->get(['id', 'name_en', 'name_kh'])
            ->keyBy('id');

        $sortMap = [];
        if ($classId || count($classIds) === 1) {
            $sortClassId = (int) ($classId ?: reset($classIds));
            $sortMap = StudentClass::query()
                ->where('class_id', $sortClassId)
                ->where('is_active', true)
                ->where('is_transfer_class', false)
                ->pluck('sort', 'student_id')
                ->all();
        }

        return collect($byStudentClass)
            ->map(function ($item) use ($students, $classes, $sortMap) {
                $s = $students->get($item['student_id']);
                $c = $classes->get($item['class_id']);

                return [
                    ...$item,
                    'sort'          => $sortMap[$item['student_id']] ?? null,
                    'name_en'       => $s?->name_en,
                    'name_kh'       => $s?->name_kh,
                    'gender'        => $s?->gender,
                    'class_name_en' => $c?->name_en,
                    'class_name_kh' => $c?->name_kh,
                ];
            })
            ->sortBy([
                ['class_name_en', 'asc'],
                ['sort', 'asc'],
                ['name_en', 'asc'],
            ])
            ->values()
            ->all();
    }

    /**
     * Attach name / gender / class label to each absent or permission event.
     *
     * @param  array<int, array{student_id:int,class_id:int,date:string,session:?string}>  $events
     * @return array<int, array<string, mixed>>
     */
    private function enrichStatusEvents(array $events): array
    {
        if ($events === []) {
            return [];
        }

        $studentIds = collect($events)->pluck('student_id')->unique()->filter()->all();
        $classIds = collect($events)->pluck('class_id')->unique()->filter()->all();

        $students = Student::query()
            ->whereIn('id', $studentIds)
            ->get(['id', 'name_en', 'name_kh', 'gender'])
            ->keyBy('id');

        $classes = Classes::query()
            ->whereIn('id', $classIds)
            ->get(['id', 'name_en', 'name_kh'])
            ->keyBy('id');

        return collect($events)
            ->map(function (array $event) use ($students, $classes) {
                $s = $students->get($event['student_id']);
                $c = $classes->get($event['class_id']);

                return [
                    ...$event,
                    'name_en'       => $s?->name_en,
                    'name_kh'       => $s?->name_kh,
                    'gender'        => $s?->gender,
                    'class_name_en' => $c?->name_en,
                    'class_name_kh' => $c?->name_kh,
                ];
            })
            ->sortBy([
                ['date', 'asc'],
                ['class_name_en', 'asc'],
                ['name_en', 'asc'],
            ])
            ->values()
            ->all();
    }
}
