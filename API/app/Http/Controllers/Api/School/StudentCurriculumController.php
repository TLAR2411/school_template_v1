<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\StudentCurriculum;
use Illuminate\Http\Request;
use App\Models\School\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\School\StudentCurriculumResource;

class StudentCurriculumController extends Controller
{
    public function studentNotYetEnrollCurriculum(Request $request){
        try {
            $curId = $this->getCur();
            $branchId = $this->getBranch();

            $students = Student::query()
            ->whereBranch($request->branch_id ?? $branchId)
    ->when($curId, function ($q) use ($curId) {
        $q->whereDoesntHave('studentCurriculums', function ($sub) use ($curId) {
            $sub->where('curriculum_id', $curId)
                ->where('is_active', true);
        });
    })
    ->when($request->search, function ($q) use ($request) {
        $q->where('name_en', 'like', '%'.$request->search.'%')
        ->orWhere('name_kh', 'like', '%'.$request->search.'%');
    })
    ->get();

            return response()->json([
                "data"=>$students,
                "status"=>true,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "message"=>$th->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request){
        $validate = $request->validate([
        'student_id'   => 'required|array|min:1',
        'student_id.*' => 'required|integer|exists:students,id',
        'start_date'   => 'nullable|date',
        'student_card_id' => 'nullable|string|max:255',
    ]);

    $curriculumId = $this->getCur();
    $branchId = $this->getBranch();
    if (!$curriculumId || $curriculumId === '*') {
        return response()->json([
            'status' => false,
            'message' => 'Please select a curriculum',
        ], 422);
    }
    if (!$branchId || $branchId === '*') {
        return response()->json([
            'status' => false,
            'message' => 'Please select a branch',
        ], 422);
    }

    try {
        DB::beginTransaction();

        foreach($validate['student_id'] as $studentId){
            $student = StudentCurriculum::create([
                'student_id' => $studentId,
                'curriculum_id' => $curriculumId,
                'branch_id' => $branchId,
                'start_date' => $request->start_date ?? now()->format('Y-m-d'),
                'student_card_id' => $request->student_card_id ?? null,
                'description' => $request->description,
                'is_active'       => true, // important
                'created_by' => auth('api')->id(),
            ]);
            }
            DB::commit();
            return response()->json([
                'status'  => true,
                'message' => 'Enrollment successful',
            ]);


    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json([
            'status'  => false,
            'message' => 'Enrollment failed',
            'error'   => $th->getMessage(),
        ], 500);
    }


    }

    public function list(Request $request){
        $curId = $this->getCur();
        $branchId = $this->getBranch();
        try {
           $data = StudentCurriculum::query()
           ->with('student')
           ->whereBranch($branchId)
           ->whereCurriculum($curId)
           ->filter($request->filter)
           ->paginate($request->limit);

           $data = StudentCurriculumResource::collection($data)->response()->getData(true);;
           return response()->json([
            'status'  => true,
            'data'    => $data,
        ], 200);
        } catch (\Throwable $th) {
            return response()->json([
            'status'  => false,
            'message' => 'Enrollment failed',
            'error'   => $th->getMessage(),
        ], 500);
        }
    }
}
