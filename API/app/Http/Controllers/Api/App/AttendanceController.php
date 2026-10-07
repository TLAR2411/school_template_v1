<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\School\Month;
use App\Models\School\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function studentHistory(Request $request)
    {
        $validated = $request->validate([
            'class_id' => ['nullable', 'integer', 'exists:classes,id'],
            'date_from' => ['nullable', 'date', 'required_with:date_to'],
            'date_to' => ['nullable', 'date', 'required_with:date_from', 'after_or_equal:date_from'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $userId = $request->user()->getAuthIdentifier();
        $perPage = (int) ($validated['per_page'] ?? 20);

        $familyIds = DB::table('family_members')
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->pluck('family_id');

        $studentIds = DB::table('family_students')
            ->whereIn('family_id', $familyIds)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->distinct()
            ->pluck('student_id');

        if ($studentIds->isEmpty()) {
            return response()->json([
                'status' => 0,
                'data' => [],
                'pagination' => [
                    'current_page' => 1,
                    'last_page' => 1,
                    'per_page' => $perPage,
                    'total' => 0,
                    'from' => null,
                    'to' => null,
                ],
            ]);
        }

        $paginator = DB::table('attendances')
            ->selectRaw('MIN(id) AS id, student_id, class_id, date, session,
                MAX(CASE WHEN is_permission = 1 THEN 1 ELSE 0 END) AS is_permission,
                MAX(CASE WHEN is_late = 1 THEN 1 ELSE 0 END) AS is_late,
                MIN(CASE WHEN is_present = 1 THEN 1 ELSE 0 END) AS is_present,
                MAX(CASE WHEN is_approved = 1 THEN 1 ELSE 0 END) AS is_approved,
                MAX(reason) AS reason')
            ->whereIn('student_id', $studentIds)
            ->when(
                ! empty($validated['class_id']),
                fn ($query) => $query->where('class_id', $validated['class_id'])
            )
            ->when(
                ! empty($validated['date_from']),
                fn ($query) => $query->whereDate('date', '>=', $validated['date_from'])
            )
            ->when(
                ! empty($validated['date_to']),
                fn ($query) => $query->whereDate('date', '<=', $validated['date_to'])
            )
            ->groupBy('student_id', 'class_id', 'date', 'session')
            ->orderByDesc('date')
            ->orderByDesc('id')
            ->paginate($perPage);

        $students = Student::query()
            ->whereIn('id', $paginator->getCollection()->pluck('student_id')->unique())
            ->get(['id', 'name_en', 'name_kh', 'photo_path'])
            ->keyBy('id');

        $paginator->setCollection(
            $paginator->getCollection()->map(function ($row) use ($students) {
                $student = $students->get($row->student_id);
                $status = match (true) {
                    (bool) $row->is_permission => 'permission',
                    (bool) $row->is_late => 'late',
                    ! (bool) $row->is_present => 'absent',
                    default => 'present',
                };

                return [
                    'id' => (int) $row->id,
                    'student_id' => (int) $row->student_id,
                    'student' => $student ? [
                        'name_en' => $student->name_en,
                        'name_kh' => $student->name_kh,
                        'photo_path' => $student->photo_path,
                    ] : null,
                    'class_id' => (int) $row->class_id,
                    'date' => $row->date,
                    'session' => $row->session,
                    'status' => $status,
                    'is_present' => (bool) $row->is_present,
                    'is_late' => (bool) $row->is_late,
                    'is_permission' => (bool) $row->is_permission,
                    'is_approved' => (bool) $row->is_approved,
                    'reason' => $row->reason,
                ];
            })
        );

        return response()->json([
            'status' => 0,
            'data' => $paginator->items(),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
        ]);
    }

    public function getMonths()
    {
        $months = Month::query()
            ->orderBy('id')
            ->get([
                'id',
                'name_en',
                'name_kh',
                'code',
            ]);

        return response()->json([
            'status' => 0,
            'months' => $months,
        ]);
    }

    public function getAttendance(Request $request)
    {
        $validated = $request->validate([
            'class_id' => ['required', 'integer', 'exists:classes,id'],
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'month_id' => ['required', 'integer', 'exists:months,id'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2100'],
        ]);

        $month = Month::query()->findOrFail($validated['month_id']);
        $monthNumber = Carbon::parse($month->name_en)->month;
        $year = $validated['year'] ?? now()->year;

        // Merge subject rows so one session is counted only once per day.
        $sessions = DB::table('attendances')
            ->selectRaw('date, session,
                MAX(CASE WHEN is_permission = 1 THEN 1 ELSE 0 END) AS is_permission,
                MAX(CASE WHEN is_late = 1 THEN 1 ELSE 0 END) AS is_late,
                MIN(CASE WHEN is_present = 1 THEN 1 ELSE 0 END) AS is_present')
            ->where('class_id', $validated['class_id'])
            ->where('student_id', $validated['student_id'])
            ->whereYear('date', $year)
            ->whereMonth('date', $monthNumber)
            ->groupBy('date', 'session')
            ->get();

        $absentCount = $sessions->filter(fn ($row) =>
            ! (bool) $row->is_permission
            && ! (bool) $row->is_late
            && ! (bool) $row->is_present
        )->count();

        $permissionCount = $sessions->where('is_permission', 1)->count();

        return response()->json([
            'status' => 0,
            'attendance' => [
                'id' => null,
                'class_id' => (int) $validated['class_id'],
                'student_id' => (int) $validated['student_id'],
                'month_id' => (int) $validated['month_id'],
                'absen' => str_pad((string) $absentCount, 2, '0', STR_PAD_LEFT),
                'permission' => str_pad((string) $permissionCount, 2, '0', STR_PAD_LEFT),
                'note' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
