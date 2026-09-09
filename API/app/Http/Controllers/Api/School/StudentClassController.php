<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\School\StudentClassResource;
use App\Models\School\Student;
use App\Models\School\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentClassController extends Controller
{

    public function studentNotYetEnrollClass(Request $request)
    {
        try {
            $classId = $request->class_id;
            $branchId = $this->getBranch();
            $curriculumId = $this->getCur();
            $students = Student::query()
                ->whereBranch($branchId)
                ->whereCur($curriculumId)
                ->where('is_active', true)
                ->whereDoesntHave('studentClasses', function ($query) use ($classId) {
                    $query->where('class_id', $classId)
                        ->where('is_active', true);
                })
                ->when($request->search, function ($q) use ($request) {
                    $q->where(function ($query) use ($request) {
                        $query->where('name_en', 'like', '%' . $request->search . '%')
                            ->orWhere('name_kh', 'like', '%' . $request->search . '%');
                    });
                })
                ->get();

            return response()->json([
                'status'  => true,
                'data'    => $students,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to get student not yet enroll class',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'class_id'     => 'required|integer|exists:classes,id',
            'student_id'   => 'required|array|min:1',
            'student_id.*' => 'required|integer|exists:students,id',
        ]);

        try {
            DB::beginTransaction();

            $classId = $validate['class_id'];

            $countStudent = StudentClass::where('class_id', $classId)->count();
            $sort = $countStudent == 0 ? 1 : $countStudent + 1;

            foreach ($validate['student_id'] as $studentId) {
                // $exists = StudentClass::where('class_id', $classId)
                //     ->where('student_id', $studentId)
                //     ->where('is_active', true)
                //     ->exists();

                // if ($exists) {
                //     continue;
                // }

                StudentClass::create([
                    'student_id'        => $studentId,
                    'class_id'          => $classId,
                    'sort'              => $sort,
                    'is_active'         => true,
                    'is_transfer_class' => false,
                    'created_by'        => auth('api')->id(),
                ]);

                $sort++;
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Students enrolled to class successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
                'error'   => $th->getMessage(),
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $classId = $request->class_id;
            $students = StudentClass::query()
                ->with('student')
                ->where('class_id', $classId)
                ->where('is_active', true)
                ->filter($request->filter)
                ->paginate($request->limit);
            $students = StudentClassResource::collection($students)->response()->getData(true);
            return response()->json([
                'status'  => true,
                'data'    => $students,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
                'error'   => $th->getMessage(),
            ], 500);
        }
    }
}
