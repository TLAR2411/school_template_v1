<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Teacher;
use App\Models\School\TeacherBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DataTableResource;

class TeacherController extends Controller
{
    public function store(Request $request)
    {


        $validate = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|max:255',
            'nation' => 'required|string|max:255',
            'photo_path' => 'nullable|string',
            // 'branch_id' => 'required_if:manage_branch,2|array|min:1',
            // 'branch_id.*' => 'integer|exists:branches,id',
            'manage_branch' => 'required|in:1,2',  // 1: single branch, 2: multiple branches
        ]);
        try {

            $branchId = $this->getBranch();

            DB::beginTransaction();
            $teacher = Teacher::create([
                'manage_branch' => $request->manage_branch,
                'name_en' => $validate['name_en'],
                'name_kh' => $validate['name_kh'],
                'dob' => $validate['dob'],
                'gender' => $validate['gender'],
                'nation' => $validate['nation'],
                'phone' => $request->phone,
                'village_code' => $request->village_code,
                'commune_code' => $request->commune_code,
                'district_code' => $request->district_code,
                'province_code' => $request->province_code,
                'cur_id' => $this->getCur(),
                'created_by' => auth('api')->id(),
                'branch_id' => $this->getBranch(),
                'photo_path' => $request->photo_path
                    ? 'storage/' . $this->storeImage($request->photo_path, 'students/images')
                    : null,
                'created_by' => auth('api')->id(),
            ]);

            $branchIds = $validate['manage_branch'] == 2
                ? $validate['branch_id']
                : [$branchId];
            foreach ($branchIds as $id) {
                TeacherBranch::create([
                    'teacher_id' => $teacher->id,
                    'branch_id' => $id,
                    'created_by' => auth('api')->id(),
                ]);
            }

            DB::commit();
            return response()->json([
                'message' => 'Teacher created successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $teacher = Teacher::query()
                ->whereBranch($this->getBranch())
                ->whereCur($this->getCur())
                ->filter($request->filter)
                ->latest('id')
                ->paginate($request->limit);
            $teacher = DataTableResource::collection($teacher)->response()->getData(true);
            return response()->json([
                'status' => true,
                'data' => $teacher,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function all()
    {
        try {
            $teacher = Teacher::query()
                ->whereBranch($this->getBranch())
                ->whereCur($this->getCur())
                ->select('id', 'name_en', 'name_kh')
                ->get();
            return response()->json([
                'status' => true,
                'data' => $teacher,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $data = Teacher::with("teacherBranches")
                ->findOrFail($request->id);
            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required|exists:teachers,id',
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|max:255',
            'nation' => 'required|string|max:255',
            'photo_path' => 'nullable|string',
            'manage_branch' => 'required|in:1,2',
            'branch_id' => 'required_if:manage_branch,2|array|min:1',
            'branch_id.*' => 'integer|exists:branches,id',
        ]);

        try {
            DB::beginTransaction();

            $teacher = Teacher::findOrFail($validate['id']);

            $photoPath = $teacher->photo_path;
            $isNewPhoto = $request->photo_path && str_starts_with($request->photo_path, 'data:');

            if ($isNewPhoto) {
                $photoPath = 'storage/' . $this->storeImage($request->photo_path, 'teachers/images');
            } elseif (!$request->photo_path) {
                $photoPath = null;
            }

            $teacher->update([
                'manage_branch' => $validate['manage_branch'],
                'name_en' => $validate['name_en'],
                'name_kh' => $validate['name_kh'],
                'dob' => $validate['dob'],
                'gender' => $validate['gender'],
                'nation' => $validate['nation'],
                'phone' => $request->phone,
                'village_code' => $request->village_code,
                'commune_code' => $request->commune_code,
                'district_code' => $request->district_code,
                'province_code' => $request->province_code,
                'photo_path' => $photoPath,
                'updated_by' => auth('api')->id(),
            ]);

            TeacherBranch::where('teacher_id', $teacher->id)->delete();

            $branchIds = $validate['manage_branch'] == 2
                ? $validate['branch_id']
                : [$this->getBranch()];

            foreach ($branchIds as $id) {
                TeacherBranch::create([
                    'teacher_id' => $teacher->id,
                    'branch_id' => $id,
                    'created_by' => auth('api')->id(),
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Teacher updated successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function disable(Request $request)
    {
        try {
            $data = Teacher::findOrFail($request->id);
            $data->update([
                'is_active' => !$data->is_active,
                'updated_by' => auth('api')->id(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Teacher disabled successfully',
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
            $teacher = Teacher::findOrFail($request->id);
            TeacherBranch::where('teacher_id', $teacher->id)->delete();
            $teacher->delete();
            return response()->json([
                'status' => true,
                'message' => 'Teacher deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
