<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /** List by class_id (for the week board) */
    public function list(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer|exists:classes,id',
        ]);

        try {
            $data = Schedule::query()
                ->where('class_id', $request->class_id)
                ->with([
                    'subject:id,name_en,name_kh,symbol',
                    'day:id,name_en,name_kh,short',
                ])
                ->orderBy('day_id')
                ->orderBy('start')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id' => 'required|integer|exists:classes,id',
            'subject_id' => 'required|integer|exists:subjects,id',
            'day_id' => 'required|integer|exists:days,id',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i|after:start',
            'color' => 'nullable|string|max:20',
        ]);

        try {
            if (Schedule::hasOverlap(
                $data['class_id'],
                $data['day_id'],
                $data['start'],
                $data['end']
            )) {
                return response()->json([
                    'status' => false,
                    'message' => 'This time overlaps another schedule for this class.',
                ], 422);
            }

            $row = Schedule::create([
                ...$data,
                'color' => $data['color'] ?? null,
                'created_by' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Schedule created successfully',
                'data' => $row->load(['subject', 'day']),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Schedule creation failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer|exists:schedules,id',
            'class_id' => 'required|integer|exists:classes,id',
            'subject_id' => 'required|integer|exists:subjects,id',
            'day_id' => 'required|integer|exists:days,id',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i|after:start',
            'color' => 'nullable|string|max:20',
        ]);

        try {
            if (Schedule::hasOverlap(
                $data['class_id'],
                $data['day_id'],
                $data['start'],
                $data['end'],
                $data['id']
            )) {
                return response()->json([
                    'status' => false,
                    'message' => 'This time overlaps another schedule for this class.',
                ], 422);
            }

            $row = Schedule::findOrFail($data['id']);
            $row->update([
                'class_id' => $data['class_id'],
                'subject_id' => $data['subject_id'],
                'day_id' => $data['day_id'],
                'start' => $data['start'],
                'end' => $data['end'],
                'color' => $data['color'] ?? $row->color,
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Schedule updated successfully',
                'data' => $row->fresh()->load(['subject', 'day']),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Schedule update failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function show(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:schedules,id',
        ]);

        try {
            $data = Schedule::with(['subject', 'day', 'class'])
                ->findOrFail($request->id);

            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:schedules,id',
        ]);

        try {
            $row = Schedule::findOrFail($request->id);
            $row->update(['deleted_by' => auth('api')->id()]);
            $row->delete();

            return response()->json([
                'status' => true,
                'message' => 'Schedule deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Schedule delete failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
