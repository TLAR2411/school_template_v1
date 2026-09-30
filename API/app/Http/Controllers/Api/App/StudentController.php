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
            $data = StudentClass::query()
                ->where('student_id', $request->student_id)
                ->with([
                    'class:id,name_en,name_kh,year_id,grade_id,symbol,class_type_id,shift_id', // need id + year_id
                    'class.year:id,name',
                    'class.shift:id,name_en,name_kh',
                    'class.classtype:name_en,name_kh'
                ])
                ->orderBy('id', 'asc')
                ->get();
            return response()->json(
                [
                    "status" => true,
                    "data" => StudentClassResource::collection($data)
                ]
            );
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
