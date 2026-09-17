<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Attendance;
use App\Models\School\Schedule;
use App\Models\School\StudentClass;
use App\Models\School\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function getAttendanceData(Request $request)
    {
        $data = $request->validate([
            'class_id'   => 'required|integer|exists:classes,id',
            'date'       => 'required|date',
            'day_id'     => 'nullable|integer|min:1|max:7',
            'subject_id' => 'nullable|integer|exists:subjects,id',
        ]);
        try {
            $classId = (int) $data['class_id'];
            $date    = Carbon::parse($data['date'])->format('Y-m-d');
            $dayId = (int) $data['day_id'];
            $subjectId = isset($data['subject_id']) ? (int) $data['subject_id'] : null;


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
            $subjectIds =  $periods->pluck('subject_id')->unique()->filter()->values()->all();

            // 2) Students — always student_class
            $studentClass = StudentClass::query()
                ->where('class_id', $classId)
                ->where('is_active', true)
                ->where('is_transfer_class', false)
                ->with('student:id,name_en,name_kh,gender')
                ->orderBy('sort')
                ->get();

            // 3) Attendance rows for this day (+ subjects in scope)
            $attendanceQuery = Attendance::query()
                ->where('class_id', $classId)
                ->whereDate('date', $date);

            if ($subjectId) {
                $attendanceQuery->where('subject_id', $subjectId);
            } elseif (!empty($subjectIds)) {
                $attendanceQuery->whereIn('subject_id', $subjectIds);
            }

            $attendanceMap = $attendanceQuery->get()->keyBy(
                fn($a) => $a->student_id . '_' . $a->subject_id
            );
            $defaultCell = [
                'attendance_id' => null,
                'is_present'    => true,
                'is_late'       => false,
                'is_permission' => false,
                'is_approved'   => false,
                'reason'        => null,
            ];

            // យក Student ម្នាក់ៗមក transform ទៅជា format ថ្មី។
            $students = $studentClass->map(function ($row) use ($subjectIds, $attendanceMap, $defaultCell) {
                $bySubject = [];
                $idsToLoop = !empty($subjectIds) ? $subjectIds : [null];
                foreach ($idsToLoop as $sid) {
                    $key = $row->student_id . '_' . $sid;
                    $saved = $sid !== null ? $attendanceMap->get($key) : null;
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
            $subjectsForSelect = $periods->map(fn($s) => [
                'id'      => $s->subject_id,
                'name_en' => $s->subject?->name_en,
                'name_kh' => $s->subject?->name_kh,
            ])->unique('id')->values();
            return response()->json([
                'status' => true,
                'data'   => [
                    'date'     => $date,
                    'day_id'   => $dayId,
                    'periods'  => $periods,
                    'subjects' => $subjectsForSelect,
                    'students' => $students,
                ],
            ]);
            // return response()->json([
            //     'scheduleQuery' => $subjectIds,
            //     'status' => true,
            //     "students" => $studentClass,
            //     'subjectIdRequest' => $subjectId,
            //     "attendanceQuery" => $attendanceQuery,
            //     'attendanceMap' => $attendanceMap
            // ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ]);
        }
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id'   => 'required|integer|exists:classes,id',
            'date'       => 'required|date',
            'day_id'     => 'nullable|integer|min:1|max:7',
            'subject_id' => 'nullable|integer|exists:subjects,id',
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

        // Which subjects to save
        if (!empty($data['subject_id'])) {
            $subjectIds = [(int) $data['subject_id']];
        } else {
            $subjectIds = Schedule::query()
                ->where('class_id', $classId)
                ->where('day_id', $dayId)
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
                    ->where('subject_id', $subjectId)
                    ->exists();

                if (!$onSchedule) {
                    DB::rollBack();
                    return response()->json([
                        'status'  => false,
                        'message' => "Subject {$subjectId} is not on the schedule for this day.",
                    ], 422);
                }

                $this->saveSubjectRows(
                    $classId,
                    $date,
                    $subjectId,
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
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    private function saveSubjectRows(
        int $classId,
        string $date,
        int $subjectId,
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
                'subject_id' => $subjectId,
                'date'       => $date,
            ];

            $values = [
                'teacher_id'    => $teacherId,
                'is_present'    => $isPresent,
                'is_late'       => $isLate,
                'is_permission' => $isPermission,
                'is_approved'   => (bool) ($row['is_approved'] ?? false),
                'reason'        => $row['reason'] ?? null,
                'updated_by'    => $userId,
                'branch_id' => $this->getBranch(),
                'cur_id' => $this->getCur()
            ];

            // attendance_id only matches THIS subject — else upsert by natural key
            if (!empty($row['attendance_id'])) {
                $byId = Attendance::query()
                    ->where('id', (int) $row['attendance_id'])
                    ->where($matchKeys)
                    ->first();

                if ($byId) {
                    $byId->update($values);
                    continue;
                }
            }

            $existing = Attendance::query()->where($matchKeys)->first();

            if ($existing) {
                $existing->update($values);
            } else {
                Attendance::create([
                    ...$matchKeys,
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
}
