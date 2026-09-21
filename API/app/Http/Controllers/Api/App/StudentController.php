<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\School\FamilyMember;
use App\Models\School\Student;
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
}
