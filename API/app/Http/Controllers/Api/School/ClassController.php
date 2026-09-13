<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataTableResource;
use App\Http\Resources\School\ClassResource;
use App\Models\School\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'nullable|string|max:255',
            'name_kh' => 'nullable|string|max:255',
            'grade_id' => 'required|integer|exists:grades,id',
            'year_id' => 'nullable|exists:years,id',
            'room_id' => 'nullable|exists:rooms,id',
            'symbol' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // $yearId = $data['year_id'] ?? $this->getYear();
        // if (!$yearId || $yearId === '*') {
        //     return response()->json(['status' => false, 'message' => 'Please select a year'], 422);
        // }

        // $branchId = $this->getBranch();
        // if (!$branchId || $branchId === '*') {
        //     return response()->json(['status' => false, 'message' => 'Please select a branch'], 422);
        // }

        try {
            Classes::create([
                "name_en" => $data['name_en'],
                "name_kh" => $data['name_kh'],
                "grade_id" => $data['grade_id'],
                "room_id" => $data['room_id'] ?? null,
                'symbol' => $data['symbol'] ?? null,
                'description' => $data['description'] ?? null,
                'year_id' => $request->year_id,
                'class_type_id' => $request->class_type_id,
                'branch_id' => $this->getBranch(),
                'is_active' => true,
                'created_by' => auth('api')->id(),
            ]);

            return response()->json(['status' => true, 'message' => 'Class created successfully']);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Class creation failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:classes,id',
            'name_en' => 'nullable|string|max:255',
            'name_kh' => 'nullable|string|max:255',
            'grade_id' => 'required|integer|exists:grades,id',
            'year_id' => 'nullable|exists:years,id',
            'room_id' => 'nullable|exists:rooms,id',
            'symbol' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $class = Classes::findOrFail($data['id']);
            $class->update([
                "name_en" => $data['name_en'],
                "name_kh" => $data['name_kh'],
                "grade_id" => $data['grade_id'],
                "room_id" => $data['room_id'] ?? null,
                'symbol' => $data['symbol'] ?? null,
                'description' => $data['description'] ?? null,
                'class_type_id' => $request->class_type_id,
                'year_id' => $request->year_id,
                'branch_id' => $this->getBranch(),
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json(['status' => true, 'message' => 'Class updated successfully']);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Class update failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $yearId = $this->getYear();
            $branchId = $this->getBranch();
            $curriculumId = $this->getCur();

            $data = Classes::query()
                ->whereYear($yearId)
                ->whereBranch($branchId)
                ->whereCurriculum($curriculumId)
                ->with([
                    'grade:id,name_en,name_kh,grade_level,edu_id',
                    'grade.educationLevel:id,name_en,name_kh',
                    'room:id,room_number',
                    'classtype:id,name_en,name_kh'
                ])
                ->filter($request->filter)
                ->latest('id')
                ->paginate($request->limit);

            $data = ClassResource::collection($data)->response()->getData(true);

            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $data = Classes::with(['grade:id,name_en,name_kh,grade_level', 'room:id,room_number'])
                ->findOrFail($request->id);

            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function all()
    {
        try {
            $yearId = $this->getYear();
            $branchId = $this->getBranch();

            $data = Classes::query()
                ->where('is_active', true)
                ->whereYear($yearId)
                ->orderBy('name_kh')
                ->get();

            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function disable(Request $request)
    {
        try {
            $item = Classes::findOrFail($request->id);
            $item->update([
                'is_active' => !$item->is_active,
                'updated_by' => auth('api')->id(),
            ]);
            return response()->json(['status' => true, 'message' => 'Class disabled successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function delete(Request $request)
    {
        try {

            Classes::findOrFail($request->id)->delete();
            return response()->json(['status' => true, 'message' => 'Class deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function detail(Request $request)
    {
        try {
            $data = Classes::query()
                ->with(['students:gender', 'grade:id,grade_level,name_en,name_kh'])
                ->get();
            return response()->json([
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
