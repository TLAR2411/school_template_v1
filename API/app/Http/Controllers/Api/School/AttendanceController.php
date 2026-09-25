<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Attendance;
use App\Models\School\Classes;
use App\Models\School\Schedule;
use App\Models\School\StudentClass;
use App\Models\School\Teacher;
use App\Services\School\AttendanceReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Optional filters: class_id, date, date_from+date_to, month_id, session.
     * Returns summary counts + per-student present / late / permission / absent.
     */
    public function report(Request $request, AttendanceReportService $service)
    {
        $data = $request->validate([
            'class_id'   => 'nullable|integer|exists:classes,id',
            'student_id' => 'nullable|integer|exists:students,id',
            'subject_id' => 'nullable|integer|exists:subjects,id',
            'session'    => 'nullable|in:AM,PM',
            // string so d-m-Y from the picker still works; service normalizes to Y-m-d
            'date'       => 'nullable|string',
            'date_from'  => 'nullable|string',
            'date_to'    => 'nullable|string',
            'month_id'   => 'nullable|integer|exists:months,id',
        ]);

        try {
            return response()->json([
                'status' => true,
                'data'   => $service->run(
                    $data,
                    $this->getBranch(),
                    $this->getCur(),
                    $this->getYear()
                ),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /** Load students + schedule + saved marks for one class/date. */
    public function getAttendanceData(Request $request)
    {
        $data = $request->validate([
            'class_id'   => 'required|integer|exists:classes,id',
            'date'       => 'required|date',
            'day_id'     => 'nullable|integer|min:1|max:7',
            'subject_id' => 'nullable|integer|exists:subjects,id',
            'session'    => 'nullable|in:AM,PM',
        ]);
        try {
            $classId = (int) $data['class_id'];
            $date    = Carbon::parse($data['date'])->format('Y-m-d');
            $dayId = isset($data['day_id'])
                ? (int) $data['day_id']
                : Carbon::parse($date)->dayOfWeekIso();
            $subjectId = isset($data['subject_id']) ? (int) $data['subject_id'] : null;

            $class = Classes::query()->with('shift')->findOrFail($classId);
            $session = $this->resolveSession($class, $date, $data['session'] ?? null);
            $isFullDay = $this->isFullDay($class);

            // 1) Schedules — filter subject BEFORE get()
            $scheduleQuery = Schedule::query()
                ->where('class_id', $classId)
                ->where('day_id', $dayId)
                ->with('subject:id,name_en,name_kh,symbol')
                ->orderBy('start');
            if ($subjectId) {
                $scheduleQuery->where('subject_id', $subjectId);
            }
            $periods = $scheduleQuery->get();
            if ($isFullDay && $session) {
                $periods = $this->filterPeriodsBySession($periods, $session, $class->shift);
            }
            $subjectIds = $periods->pluck('subject_id')->unique()->filter()->values()->all();

            // 2) Students — always student_class
            $studentClass = StudentClass::query()
                ->where('class_id', $classId)
                ->where('is_active', true)
                ->where('is_transfer_class', false)
                ->with('student:id,name_en,name_kh,gender')
                ->orderBy('sort')
                ->get();

            // 3) Attendance rows for this day (+ session / subjects in scope)
            $attendanceQuery = Attendance::query()
                ->where('class_id', $classId)
                ->whereDate('date', $date);

            if ($subjectId) {
                $attendanceQuery->where('subject_id', $subjectId);
            } elseif (!empty($subjectIds)) {
                $attendanceQuery->whereIn('subject_id', $subjectIds);
            }
            if ($session) {
                $attendanceQuery->where(function ($q) use ($session) {
                    $q->where('session', $session)->orWhereNull('session');
                });
            }

            $attendanceMap = $attendanceQuery->get()->keyBy(
                fn ($a) => $a->student_id . '_' . ($a->subject_id ?? 'general')
            );
            $defaultCell = [
                'attendance_id' => null,
                'is_present'    => true,
                'is_late'       => false,
                'is_permission' => false,
                'is_approved'   => false,
                'reason'        => null,
            ];

            $idsToLoop = !empty($subjectIds) ? $subjectIds : [null];

            // យក Student ម្នាក់ៗមក transform ទៅជា format ថ្មី។
            $students = $studentClass->map(function ($row) use ($idsToLoop, $attendanceMap, $defaultCell) {
                $bySubject = [];
                foreach ($idsToLoop as $sid) {
                    $key = $row->student_id . '_' . ($sid ?? 'general');
                    $saved = $attendanceMap->get($key);
                    $bySubject[$sid ?? 'general'] = $saved ? [
                        'attendance_id' => $saved->id,
                        'is_present'    => (bool) $saved->is_present,
                        'is_late'       => (bool) $saved->is_late,
                        'is_permission' => (bool) $saved->is_permission,
                        'is_approved'   => (bool) $saved->is_approved,
                        'reason'        => $saved->reason,
                    ] : $defaultCell;
                }
                $student = $row->student;
                return [
                    'student_id' => $row->student_id,
                    'sort'       => $row->sort,
                    'name_en'    => $student?->name_en,
                    'name_kh'    => $student?->name_kh,
                    'gender'     => $student?->gender,
                    'photo_path' => $student?->photo_path,
                    'by_subject' => $bySubject,
                ];
            })->values();
            $subjectsForSelect = $periods->map(fn ($s) => [
                'id'      => $s->subject_id,
                'name_en' => $s->subject?->name_en,
                'name_kh' => $s->subject?->name_kh,
            ])->unique('id')->values();
            return response()->json([
                'status' => true,
                'data'   => [
                    'date'              => $date,
                    'day_id'            => $dayId,
                    'session'           => $session,
                    'shift_code'        => $this->shiftCode($class),
                    'is_full_day'       => $isFullDay,
                    'session_submitted' => $isFullDay
                        ? $this->sessionSubmittedMap($classId, $date)
                        : null,
                    'periods'           => $periods,
                    'subjects'          => $subjectsForSelect,
                    'students'          => $students,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
        }
    }

    /** Save present / late / permission for the current session (and subject if any). */
    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id'   => 'required|integer|exists:classes,id',
            'date'       => 'required|date',
            'day_id'     => 'nullable|integer|min:1|max:7',
            'subject_id' => 'nullable|integer|exists:subjects,id',
            'session'    => 'nullable|in:AM,PM',
            'rows'       => 'required|array|min:1',
            'rows.*.student_id'    => 'required|integer|exists:students,id',
            'rows.*.attendance_id' => 'nullable|integer|exists:attendances,id',
            'rows.*.is_present'    => 'required|boolean',
            'rows.*.is_late'       => 'required|boolean',
            'rows.*.is_permission' => 'required|boolean',
            'rows.*.is_approved'   => 'nullable|boolean',
            'rows.*.reason'        => 'nullable|string|max:255',
        ]);

        $classId = (int) $data['class_id'];
        $date    = Carbon::parse($data['date'])->format('Y-m-d');
        $dayId   = isset($data['day_id'])
            ? (int) $data['day_id']
            : Carbon::parse($date)->dayOfWeekIso();

        $class = Classes::query()->with('shift')->findOrFail($classId);
        $session = $this->resolveSession($class, $date, $data['session'] ?? null);
        $isFullDay = $this->isFullDay($class);

        $userId    = auth('api')->id();
        $teacherId = Teacher::query()->where('user_id', $userId)->value('id');

        $allowedMap = array_flip(
            StudentClass::query()
                ->where('class_id', $classId)
                ->where('is_active', true)
                ->where('is_transfer_class', false)
                ->pluck('student_id')
                ->all()
        );

        // No subject = all subjects in this session (Full Day morning 4, afternoon 2, …)
        if (!empty($data['subject_id'])) {
            $subjectIds = [(int) $data['subject_id']];
        } else {
            $periodQuery = Schedule::query()
                ->where('class_id', $classId)
                ->where('day_id', $dayId);
            if ($isFullDay && $session) {
                $this->applySessionTimeFilter($periodQuery, $session, $class->shift);
            }
            $subjectIds = $periodQuery
                ->pluck('subject_id')
                ->unique()
                ->filter()
                ->values()
                ->all();

            if (empty($subjectIds)) {
                return response()->json([
                    'status'  => false,
                    'message' => 'No schedule for this class on this day.',
                ], 422);
            }
        }

        try {
            DB::beginTransaction();

            foreach ($subjectIds as $subjectId) {
                $subjectId = (int) $subjectId;

                $onSchedule = Schedule::query()
                    ->where('class_id', $classId)
                    ->where('day_id', $dayId)
                    ->where('subject_id', $subjectId);
                if ($isFullDay && $session) {
                    $this->applySessionTimeFilter($onSchedule, $session, $class->shift);
                }

                if (!$onSchedule->exists()) {
                    DB::rollBack();
                    return response()->json([
                        'status'  => false,
                        'message' => "Subject {$subjectId} is not on the schedule for this session.",
                    ], 422);
                }

                $this->saveSubjectRows(
                    $classId,
                    $date,
                    $subjectId,
                    $session,
                    $data['rows'],
                    $userId,
                    $teacherId,
                    $allowedMap
                );
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Attendance saved successfully',
                'session' => $session,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /** Insert or update one student row for one subject + session. */
    private function saveSubjectRows(
        int $classId,
        string $date,
        ?int $subjectId,
        ?string $session,
        array $rows,
        $userId,
        ?int $teacherId,
        array $allowedMap
    ): void {
        foreach ($rows as $row) {
            $studentId = (int) $row['student_id'];

            if (!isset($allowedMap[$studentId])) {
                throw new \RuntimeException("Student {$studentId} is not enrolled in this class.");
            }

            [$isPresent, $isLate, $isPermission] = $this->normalizeAttendanceFlags(
                (bool) $row['is_present'],
                (bool) $row['is_late'],
                (bool) $row['is_permission']
            );

            $matchKeys = [
                'student_id' => $studentId,
                'class_id'   => $classId,
                'date'       => $date,
            ];

            $values = [
                'teacher_id'    => $teacherId,
                'session'       => $session,
                'is_present'    => $isPresent,
                'is_late'       => $isLate,
                'is_permission' => $isPermission,
                'is_approved'   => (bool) ($row['is_approved'] ?? false),
                'reason'        => $row['reason'] ?? null,
                'updated_by'    => $userId,
                'branch_id' => $this->getBranch(),
                'cur_id' => $this->getCur()
            ];

            $scoped = function ($query) use ($matchKeys, $subjectId, $session) {
                $query->where($matchKeys);
                if ($subjectId === null) {
                    $query->whereNull('subject_id');
                } else {
                    $query->where('subject_id', $subjectId);
                }
                if ($session) {
                    $query->where('session', $session);
                } else {
                    $query->whereNull('session');
                }
            };

            // attendance_id only matches THIS subject + session — else upsert by natural key
            if (!empty($row['attendance_id'])) {
                $byId = Attendance::query()
                    ->where('id', (int) $row['attendance_id'])
                    ->where(fn ($q) => $scoped($q))
                    ->first();

                if ($byId) {
                    $byId->update($values);
                    continue;
                }
            }

            $existing = Attendance::query()->where(fn ($q) => $scoped($q))->first();

            if (!$existing && $session) {
                $legacy = Attendance::query()
                    ->where($matchKeys)
                    ->whereNull('session')
                    ->when(
                        $subjectId === null,
                        fn ($q) => $q->whereNull('subject_id'),
                        fn ($q) => $q->where('subject_id', $subjectId)
                    )
                    ->first();
                if ($legacy) {
                    $legacy->update($values);
                    continue;
                }
            }

            if ($existing) {
                $existing->update($values);
            } else {
                Attendance::create([
                    ...$matchKeys,
                    'subject_id' => $subjectId,
                    ...$values,
                    'created_by' => $userId,
                    'teacher_id' => $userId,
                    'branch_id' => $this->getBranch(),
                    'cur_id' => $this->getCur()
                ]);
            }
        }
    }

    /** Same rules as CheckAttendance.vue */
    private function normalizeAttendanceFlags(
        bool $isPresent,
        bool $isLate,
        bool $isPermission
    ): array {
        if ($isPermission) {
            return [false, false, true];
        }
        if ($isLate) {
            return [true, true, false];
        }
        if (!$isPresent) {
            return [false, false, false];
        }
        return [true, false, false];
    }

    /** AM / PM from class shift. FULL from clock (optional override). */
    private function resolveSession(Classes $class, string $date, ?string $override = null): ?string
    {
        $code = $this->shiftCode($class);

        if ($code === 'AM' || $code === 'PM') {
            return $code;
        }

        if ($code !== 'FULL') {
            return null;
        }

        $override = $override ? strtoupper($override) : null;
        if (in_array($override, ['AM', 'PM'], true)) {
            return $override;
        }

        $now = Carbon::now()->format('H:i:s');
        [$breakStart, $breakEnd] = $this->breakTimes($class->shift);

        if ($now < $breakStart) {
            return 'AM';
        }
        if ($now >= $breakEnd) {
            return 'PM';
        }

        $morningSaved = Attendance::query()
            ->where('class_id', $class->id)
            ->whereDate('date', $date)
            ->where('session', 'AM')
            ->whereNotNull('subject_id')
            ->exists();

        return $morningSaved ? 'PM' : 'AM';
    }

    private function isFullDay(Classes $class): bool
    {
        return $this->shiftCode($class) === 'FULL';
    }

    private function shiftCode(Classes $class): string
    {
        return strtoupper((string) ($class->shift?->code ?? ''));
    }

    /** Lunch window from shift, with Full Day defaults 11:00–14:00. */
    private function breakTimes($shift): array
    {
        $start = Carbon::parse($shift?->break_start ?? '11:00:00')->format('H:i:s');
        $end = Carbon::parse($shift?->break_end ?? '14:00:00')->format('H:i:s');

        return [$start, $end];
    }

    /** Keep only morning or afternoon periods for a Full Day class. */
    private function filterPeriodsBySession($periods, string $session, $shift)
    {
        return $periods
            ->filter(fn ($period) => $this->periodBelongsToSession($period, $session, $shift))
            ->values();
    }

    private function periodBelongsToSession($period, string $session, $shift): bool
    {
        if (!$period->start) {
            return false;
        }

        $start = Carbon::parse($period->start)->format('H:i:s');
        [$breakStart, $breakEnd] = $this->breakTimes($shift);

        if ($session === 'AM') {
            return $start < $breakStart;
        }

        return $start >= $breakEnd;
    }

    /** SQL filter: period.start is in AM or PM for Full Day. */
    private function applySessionTimeFilter($query, string $session, $shift): void
    {
        [$breakStart, $breakEnd] = $this->breakTimes($shift);

        if ($session === 'AM') {
            $query->where('start', '<', $breakStart);
        } else {
            $query->where('start', '>=', $breakEnd);
        }
    }

    /** Which Full Day sessions already have at least one saved row today. */
    private function sessionSubmittedMap(int $classId, string $date): array
    {
        $saved = Attendance::query()
            ->where('class_id', $classId)
            ->whereDate('date', $date)
            ->whereNotNull('subject_id')
            ->whereIn('session', ['AM', 'PM'])
            ->distinct()
            ->pluck('session')
            ->all();

        return [
            'AM' => in_array('AM', $saved, true),
            'PM' => in_array('PM', $saved, true),
        ];
    }
}
