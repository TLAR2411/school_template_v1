<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataTableResource;
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
                'year_id' => $this->getYear(),
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
            Classes::findOrFail($data['id'])->update([
                ...collect($data)->except('id')->all(),
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

            $data = Classes::query()
                ->when($yearId && $yearId !== '*', fn($q) => $q->where('year_id', $yearId))
                ->when($branchId && $branchId !== '*', fn($q) => $q->where('branch_id', $branchId))
                ->with(['grade:id,name_en,name_kh,grade_level', 'room:id,room_number'])
                ->filter($request->filter)
                ->latest('id')
                ->paginate($request->limit);

            $data = DataTableResource::collection($data)->response()->getData(true);

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
                ->when($yearId && $yearId !== '*', fn($q) => $q->where('year_id', $yearId))
                ->when($branchId && $branchId !== '*', fn($q) => $q->where('branch_id', $branchId))
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
}
