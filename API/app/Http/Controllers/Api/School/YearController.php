<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Year;
use Illuminate\Http\Request;
use App\Http\Resources\DataTableResource;

class YearController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        try {
            Year::create([
                'name' => $validate['name'],
                'start_date' => $validate['start_date'],
                'end_date' => $validate['end_date'],
                'created_by' => auth('api')->id(),
            ]);

            return response()->json([
                'message' => 'Year created successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Year creation failed',
                'error' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|exists:years,id',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        try {
            Year::findOrFail($validate['id'])->update([
                'name' => $validate['name'],
                'start_date' => $validate['start_date'],
                'end_date' => $validate['end_date'],
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'message' => 'Year updated successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Year update failed',
                'error' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $data = Year::query()
                ->filter($request->filter)
                ->orderByDesc('start_date')
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
            $data = Year::findOrFail($request->id);

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
            $data = Year::query()
                ->where('is_active', true)
                ->orderByDesc('start_date')
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
            $data = Year::findOrFail($request->id);
            $data->update([
                'is_active' => !$data->is_active,
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Year disabled successfully',
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
            Year::findOrFail($request->id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Year deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
