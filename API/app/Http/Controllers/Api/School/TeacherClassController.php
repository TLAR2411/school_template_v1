<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Teacher;
use App\Models\School\TeacherClass;
use Illuminate\Http\Request;

class TeacherClassController extends Controller
{
    public function store(Request $request)
    {
        try {
            $subjectIds = $request->subject_ids;
            foreach ($subjectIds as $sId) {
                TeacherClass::create([
                    'teacher_id' => $request->teacher_id,
                    'subject_id' => $sId,
                    'class_id' => $request->class_id,
                    'is_assisstant' => $request->is_assisstant ?? false,
                    'is_classload' => $request->is_classload ?? false,
                    'created_by' => auth('api')->id()
                ]);
            }
            return response()->json(['message' => "Create success", 'status' => true]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function list(Request $request)
    {
        try {
            $request->validate([
                'class_id' => 'required|integer',
            ]);

            $rows = TeacherClass::query()
                ->where('class_id', $request->class_id)
                ->with(['teacher', 'subject'])
                ->orderBy('teacher_id')
                ->get();

            // Group by teacher_id in PHP
            $data = $rows
                ->groupBy('teacher_id')
                ->map(function ($items) {
                    $first = $items->first();
                    $teacher = $first->teacher;

                    return [
                        'teacher_id' => $first->teacher_id,
                        'class_id' => $first->class_id,
                        'name_en' => $teacher?->name_en,
                        'name_kh' => $teacher?->name_kh,
                        'photo_path' => $teacher?->photo_path,
                        'phone' => $teacher?->phone,
                        'email' => $teacher?->email,
                        'is_classload' => (bool) $items->contains('is_classload', true),
                        'is_assisstant' => (bool) $items->contains('is_assisstant', true),
                        // all subjects for this teacher in this class
                        'subjects' => $items->map(fn($row) => [
                            'id' => $row->id,              // teacher_class row id (for delete one subject)
                            'subject_id' => $row->subject_id,
                            'name_en' => $row->subject?->name_en,
                            'name_kh' => $row->subject?->name_kh,
                            'symbol' => $row->subject?->symbol,
                            'is_classload' => $row->is_classload,
                            'is_assisstant' => $row->is_assisstant,
                        ])->values(),
                        'subject_ids' => $items->pluck('subject_id')->values(),
                    ];
                })
                ->values();

            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function show(Request $request)
    {
        try {
            $request->validate([
                'class_id' => 'required|integer',
                'teacher_id' => 'required|integer',
            ]);

            $rows = TeacherClass::query()
                ->where('class_id', $request->class_id)
                ->where('teacher_id', $request->teacher_id)
                ->get();

            if ($rows->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Teacher class not found',
                ], 404);
            }

            $first = $rows->first();

            return response()->json([
                'status' => true,
                'data' => [
                    'isEdit' => true,

                    'teacher_id' => $first->teacher_id,
                    'class_id' => $first->class_id,
                    'is_assisstant' => (bool) $rows->contains('is_assisstant', true),
                    'is_classload' => (bool) $rows->contains('is_classload', true),
                    'subject_ids' => $rows->pluck('subject_id')->values(), // [1, 2]
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = TeacherClass::query()
                ->where('class_id', $request->class_id)
                ->where('teacher_id', $request->teacher_id)
                ->delete();
            return response()->json([
                'message' => "Delete Success",
                'status' => 1
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function delete_subject(Request $request)
    {
        try {
            $request->validate(['id' => 'required|integer']);
            $row = TeacherClass::findOrFail($request->id);
            $row->delete();
            return response()->json([
                'status' => true,
                'message' => 'Subject removed from teacher',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'old_teacher_id' => 'required|integer', // current teacher
            'teacher_id' => 'required|integer',     // new teacher
            'is_assisstant' => 'nullable|boolean',
            'is_classload' => 'nullable|boolean',
        ]);
        try {
            // Move all subject rows of this class from old teacher → new teacher
            TeacherClass::query()
                ->where('class_id', $request->class_id)
                ->where('teacher_id', $request->old_teacher_id)
                ->update([
                    'teacher_id' => $request->teacher_id,
                    'is_assisstant' => $request->is_assisstant ?? false,
                    'is_classload' => $request->is_classload ?? false,
                    'updated_by' => auth('api')->id(),
                ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Unique subjects assigned to a class via teacher_class.
     * Used by Schedule subject picker.
     */
    public function subjectClass(Request $request)
    {
        try {
            $request->validate([
                'class_id' => 'required|integer',
            ]);

            $rows = TeacherClass::query()
                ->where('class_id', $request->class_id)
                ->with(['subject', 'teacher'])
                ->get();

            $data = $rows
                ->filter(fn($row) => $row->subject)
                ->unique('subject_id')
                ->map(fn($row) => [
                    'id' => $row->subject_id,
                    'teacher_class_id' => $row->id,
                    'name_en' => $row->subject->name_en,
                    'name_kh' => $row->subject->name_kh,
                    'symbol' => $row->subject->symbol,
                    'teacher_id' => $row->teacher_id,
                    'teacher_name_en' => $row->teacher?->name_en,
                    'teacher_name_kh' => $row->teacher?->name_kh,
                ])
                ->values();

            return response()->json([
                'data' => $data,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
