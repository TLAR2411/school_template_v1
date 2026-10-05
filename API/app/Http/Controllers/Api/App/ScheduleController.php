<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\School\FamilyMember;
use App\Models\School\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function list(Request $request)
    {
        $validated = $request->validate([
            'class_id' => ['required', 'integer', 'exists:classes,id'],
        ]);

        $classId = (int) $validated['class_id'];
        $userId = $request->user()->getAuthIdentifier();

        $familyIds = FamilyMember::query()
            ->where('user_id', $userId)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->pluck('family_id');

        $studentIds = DB::table('family_students')
            ->whereIn('family_id', $familyIds)
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->pluck('student_id');

        $canViewClass = DB::table('student_class')
            ->where('class_id', $classId)
            ->whereIn('student_id', $studentIds)
            ->where('is_active', true)
            ->where('is_transfer_class', false)
            ->whereNull('deleted_at')
            ->exists();

        if (! $canViewClass) {
            return response()->json([
                'status' => 1,
                'message' => 'You do not have access to this class schedule',
            ], 403);
        }

        $schedules = Schedule::query()
            ->where('class_id', $classId)
            ->with([
                'subject:id,name_en,name_kh,symbol',
                'day:id,name_en,name_kh,short',
            ])
            ->orderBy('day_id')
            ->orderBy('start')
            ->get()
            ->groupBy('day_id')
            ->map(function ($periods, $dayId) {
                $day = $periods->first()->day;

                return [
                    'day_id' => (int) $dayId,
                    'day' => $day ? [
                        'name_en' => $day->name_en,
                        'name_kh' => $day->name_kh,
                        'short' => $day->short,
                    ] : null,
                    'periods' => $periods->map(fn ($period) => [
                        'id' => $period->id,
                        'subject_id' => $period->subject_id,
                        'subject' => $period->subject ? [
                            'name_en' => $period->subject->name_en,
                            'name_kh' => $period->subject->name_kh,
                            'symbol' => $period->subject->symbol,
                        ] : null,
                        'title' => $period->title,
                        'color' => $period->color,
                        'start' => $this->formatTime($period->start),
                        'end' => $this->formatTime($period->end),
                    ])->values(),
                ];
            })
            ->values();

        return response()->json([
            'status' => 0,
            'class_id' => $classId,
            'schedules' => $schedules,
        ]);
    }

    private function formatTime(?string $time): ?string
    {
        return $time ? Carbon::parse($time)->format('H:i') : null;
    }
}
