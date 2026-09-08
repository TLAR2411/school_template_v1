<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\EducationLevel;
use Illuminate\Http\Request;
use App\Http\Resources\DataTableResource;

class EducationLevelController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'symbol' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            EducationLevel::create([
                'name_en' => $validate['name_en'],
                'name_kh' => $validate['name_kh'],
                'symbol' => $request->symbol,
                'description' => $request->description,
                'created_by' => auth('api')->id(),
            ]);

            return response()->json([
                'message' => 'Education level created successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Education level creation failed',
                'error' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|exists:education_levels,id',
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'symbol' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            EducationLevel::findOrFail($validate['id'])->update([
                'name_en' => $validate['name_en'],
                'name_kh' => $validate['name_kh'],
                'symbol' => $request->symbol,
                'description' => $request->description,
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'message' => 'Education level updated successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Education level update failed',
                'error' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $data = EducationLevel::query()
                ->filter($request->filter)
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
            $data = EducationLevel::findOrFail($request->id);

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
        try {
            $data = EducationLevel::query()
                ->where('is_active', true)
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
            $data = EducationLevel::findOrFail($request->id);
            $data->update([
                'is_active' => !$data->is_active,
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Education level disabled successfully',
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
            EducationLevel::findOrFail($request->id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Education level deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
