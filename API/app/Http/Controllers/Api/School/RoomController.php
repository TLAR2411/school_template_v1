<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Room;
use Illuminate\Http\Request;
use App\Http\Resources\DataTableResource;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            'room_number' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            Room::create([
                'room_number' => $validate['room_number'],
                'floor' => $request->floor,
                'building' => $request->building,
                'description' => $request->description,
                'is_active' => true,
                'created_by' => auth('api')->id(),
            ]);

            return response()->json([
                'message' => 'Room created successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Room creation failed',
                'error' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|exists:rooms,id',
            'room_number' => 'required|string|max:255',
            'floor' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            Room::findOrFail($validate['id'])->update([
                'room_number' => $validate['room_number'],
                'floor' => $request->floor,
                'building' => $request->building,
                'description' => $request->description,
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'message' => 'Room updated successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Room update failed',
                'error' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $data = Room::query()
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
            $data = Room::findOrFail($request->id);

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
            $data = Room::query()
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
            $data = Room::findOrFail($request->id);
            $data->update([
                'is_active' => !$data->is_active,
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Room disabled successfully',
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
            Room::findOrFail($request->id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Room deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
