<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\StudentFamily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFamilyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'family_id' => 'required|integer|exists:families,id',
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'integer|exists:students,id',
        ]);

        try {
            $createdBy = auth('api')->id();
            $familyId = $validated['family_id'];
            $added = 0;

            DB::beginTransaction();

            foreach ($validated['student_ids'] as $studentId) {
                $exists = StudentFamily::query()
                    ->where('family_id', $familyId)
                    ->where('student_id', $studentId)
                    ->exists();

                if ($exists) {
                    continue;
                }

                StudentFamily::create([
                    'family_id' => $familyId,
                    'student_id' => $studentId,
                    'created_by' => $createdBy,
                ]);
                $added++;
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $added
                    ? 'Student added to family successfully'
                    : 'Students already linked to this family',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'student_family_id' => 'required|integer|exists:family_students,id',
            ]);

            StudentFamily::query()
                ->where('id', $request->student_family_id)
                ->delete();

            return response()->json([
                'message' => 'Remove Success',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }
}
