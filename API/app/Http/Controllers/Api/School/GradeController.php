<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataTableResource;
use App\Models\School\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name_en' => 'nullable|string|max:255',
            'name_kh' => 'nullable|string|max:255',
            'symbol' => 'nullable|string|max:255',
            'grade_level' => 'nullable|integer|min:1|max:12',
            'edu_id' => 'nullable|integer|exists:education_levels,id',
            'cur_id' => 'nullable|integer|exists:curriculums,id',
            'description' => 'nullable|string|max:255',
        ]);

        $curId = $validate['cur_id'] ?? $this->getCur();
        if (!$curId || $curId === '*') {
            return response()->json([
                'status' => false,
                'message' => 'Please select a curriculum',
            ], 422);
        }

        try {
            Grade::create([
                'name_en' => $validate['name_en'],
                'name_kh' => $validate['name_kh'],
                'symbol' => $request->symbol,
                'grade_level' => $request->grade_level,
                'edu_id' => $request->edu_id,
                'cur_id' => $curId,
                'year_id' => $this->getYear(),
                'branch_id' => $this->getBranch() !== '*' ? $this->getBranch() : null,
                'description' => $request->description,
                'is_active' => true,
                'created_by' => auth('api')->id(),
            ]);

            return response()->json([
                'message' => 'Grade created successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Grade creation failed',
                'error' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|exists:grades,id',
            'name_en' => 'nullable|string|max:255',
            'name_kh' => 'nullable|string|max:255',
            'symbol' => 'nullable|string|max:255',
            'grade_level' => 'nullable|integer|min:1|max:12',
            'edu_id' => 'nullable|integer|exists:education_levels,id',
            'cur_id' => 'nullable|integer|exists:curriculums,id',
            'description' => 'nullable|string|max:255',
        ]);

        $curId = $validate['cur_id'] ?? $this->getCur();
        if (!$curId || $curId === '*') {
            return response()->json([
                'status' => false,
                'message' => 'Please select a curriculum',
            ], 422);
        }

        try {
            Grade::findOrFail($validate['id'])->update([
                'name_en' => $validate['name_en'],
                'name_kh' => $validate['name_kh'],
                'symbol' => $request->symbol,
                'grade_level' => $request->grade_level,
                'edu_id' => $request->edu_id,
                'cur_id' => $curId,
                'description' => $request->description,
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'message' => 'Grade updated successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Grade update failed',
                'error' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function list(Request $request)
    {
        $curId = $this->getCur();

        try {
            $data = Grade::query()
                ->when($curId && $curId !== '*', function ($q) use ($curId) {
                    $q->where('cur_id', $curId);
                })
                ->with('educationLevel:id,name_en,name_kh')
                ->filter($request->filter)
                ->orderBy('grade_level')
                ->paginate($request->limit);

            $data = DataTableResource::collection($data)->response()->getData(true);

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

    public function show(Request $request)
    {
        try {
            $data = Grade::findOrFail($request->id);

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

    public function all()
    {
        $curId = $this->getCur();

        try {
            $data = Grade::query()
                ->where('is_active', true)
                ->when($curId && $curId !== '*', function ($q) use ($curId) {
                    $q->where('cur_id', $curId);
                })
                ->orderBy('grade_level')
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

    public function disable(Request $request)
    {
        try {
            $data = Grade::findOrFail($request->id);
            $data->update([
                'is_active' => !$data->is_active,
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Grade disabled successfully',
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
        try {
            Grade::findOrFail($request->id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Grade deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
