<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\School\Month;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
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
