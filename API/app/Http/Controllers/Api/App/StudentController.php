<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\App\StudentClassResource;
use App\Models\School\FamilyMember;
use App\Models\School\Student;
use App\Models\School\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function list(Request $request)
    {
        $userId = $request->userId ?? Auth::id();
        try {
            $familyIds = FamilyMember::query()
                ->where('user_id', $userId)
                ->where('is_active', true)
                ->pluck('family_id');

            if ($familyIds->isEmpty()) {
                return response()->json([
                    'status' => true,
                    'data' => [],
                ]);
            }

            $students = Student::query()
                ->where('is_active', true)
                ->whereIn('id', function ($query) use ($familyIds) {
                    $query->select('student_id')
                        ->from('family_students')
                        ->whereIn('family_id', $familyIds)
                        ->where('is_active', true);
                })
                ->get([
                    'id',
                    'name_en',
                    'name_kh',
                    'photo_path',
                    'gender',
                    'dob',
                ]);
            return response()->json([
                'status' => true,
                'data' => $students,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function studentClass(Request $request)
    {
         try {
            $familyIds = FamilyMember::query()
                ->where('user_id', Auth::id())
                ->where('is_active', true)
                ->pluck('family_id');

            if ($familyIds->isEmpty()) {
                return response()->json([
                    'status' => true,
                    'data' => [],
                ]);
            }

            $classes = StudentClass::query()
                ->with([
                    'student:id,name_en,name_kh,photo_path,gender,dob',
                    'class.grade',
                    'class.room',
                    'class.shift',
                    'class.year',
                    'class.classtype',
                    'class.branch:id,name_en,name_kh',
                ])
                ->whereIn('student_id', function ($query) use ($familyIds) {
                    $query->select('student_id')
                        ->from('family_students')
                        ->whereIn('family_id', $familyIds)
                        ->where('is_active', true);
                })
                ->where('is_active', true)
                ->whereHas('class', function ($query) {
                    $query->where('is_active', true);
                })
                ->orderBy('sort')
                ->get();

            $classes->each(function (StudentClass $studentClass) {
                if ($studentClass->class) {
                    $studentClass->class->setAttribute(
                        'branch_name',
                        $studentClass->class->branch?->name_en
                            ?: $studentClass->class->branch?->name_kh
                    );
                    $studentClass->class->unsetRelation('branch');
                }
            });

            return response()->json([
                'status' => true,
                'data' => $classes,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to get classes for student',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
}
