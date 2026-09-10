<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataTableResource;
use App\Models\School\SubjectActivityType;
use Illuminate\Http\Request;

class SubjectActivityTypeController extends Controller
{
    public function list(Request $request)
    {
        try {
            $data = SubjectActivityType::query()
                ->where('is_active', true)
                ->paginate($request->limit);
            $data = DataTableResource::collection($data)->response()->getData(true);
            return response()->json([
                'data' => $data,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
    public function show(Request $request)
    {
        try {
            $data = SubjectActivityType::findOrFail($request->id);
            return response()->json([
                'data' => $data,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
    public function update(Request $request)
    {
        try {
            $data = SubjectActivityType::findOrFail($request->id);
            $data->update([
                "name_en" => $request->name_en,
                "name_kh" => $request->name_kh,
                "symbol" => $request->symbol,
                'updated_by' => auth('api')->id()
            ]);

            return response()->json([
                "message" => "Update Success",
                "status" => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {

            SubjectActivityType::create([
                "name_en" => $request->name_en,
                "name_kh" => $request->name_kh,
                "symbol" => $request->symbol,
                'created_by' => auth('api')->id()
            ]);

            return response()->json([
                "message" => "Create Success",
                "status" => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
    public function delete(Request $request)
    {
        try {
            $data = SubjectActivityType::findOrFail($request->id);
            $data->delete();

            return response()->json([
                "message" => "Delete Success",
                "status" => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
    public function all(Request $request)
    {
        try {
            $data = SubjectActivityType::query()
                ->where('is_active', true);
            return response()->json([
                'data' => $data,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
}
