<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Student;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\DataTableResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
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
        ]);
        try {
            $student = Student::create([
                'name_en' => $validate['name_en'],
                'name_kh' => $validate['name_kh'],
                'dob' => $validate['dob'],
                'gender' => $validate['gender'],
                'nation' => $validate['nation'],
                'phone' => $request->phone,
                'email' => $request->email,
                'village_code' => $request->village_code,
                'commune_code' => $request->commune_code,
                'district_code' => $request->district_code,
                'province_code' => $request->province_code,
                'b_village_code' => $request->b_village_code,
                'b_commune_code' => $request->b_commune_code,
                'b_district_code' => $request->b_district_code,
                'b_province_code' => $request->b_province_code,
                'created_by' => auth('api')->id(),
                'branch_id' => $this->getBranch(),
                'photo_path' => $request->photo_path
                    ? 'storage/' . $this->storeImage($request->photo_path, 'students/images')
                    : null,
                'created_by' => auth('api')->id(),
            ]);
            return response()->json([
                'message' => 'Student created successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Student creation failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {

        $validate = $request->validate([
            'id' => 'required|exists:students,id',
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|max:255',
            'nation' => 'required|string|max:255',
            'photo_path' => 'nullable|string',
        ]);
        try {
            $student = Student::findOrFail($validate['id']);

            // Photo: keep the existing path, replace it with a new upload (base64),
            // or clear it when the user removed the photo.
            $photoPath = $student->photo_path;
            $isNewPhoto = $request->photo_path && str_starts_with($request->photo_path, 'data:');

            if ($isNewPhoto || !$request->photo_path) {
                if ($student->photo_path) {
                    Storage::disk('public')->delete(preg_replace('/^storage\//', '', $student->photo_path));
                }
                $photoPath = $isNewPhoto
                    ? 'storage/' . $this->storeImage($request->photo_path, 'students/images')
                    : null;
            }

            $student->update([
                'name_en' => $validate['name_en'],
                'name_kh' => $validate['name_kh'],
                'dob' => $validate['dob'],
                'gender' => $validate['gender'],
                'nation' => $validate['nation'],
                'phone' => $request->phone,
                'email' => $request->email,
                'village_code' => $request->village_code,
                'commune_code' => $request->commune_code,
                'district_code' => $request->district_code,
                'province_code' => $request->province_code,
                'b_village_code' => $request->b_village_code,
                'b_commune_code' => $request->b_commune_code,
                'b_district_code' => $request->b_district_code,
                'b_province_code' => $request->b_province_code,
                'photo_path' => $photoPath,
                'updated_by' => auth('api')->id(),
            ]);
            return response()->json([
                'message' => 'Student updated successfully',
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Student update failed',
                'error' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $data  = Student::query()
                ->whereBranch($this->getBranch())
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
            $data = Student::findOrFail($request->id);
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

    public function all(Request $request)
    {
        try {
            $branchId = $request->branch_id ?? $this->getBranch();
            $search = $request->search ?? data_get($request->filter, 'search');

            $data = Student::query()
                ->whereBranch($branchId)
                ->filter(['search' => $search])
                ->select(
                    'id',
                    'name_en',
                    'name_kh',
                    'phone',
                    'branch_id',
                    'photo_path',
                )
                ->orderBy('name_en')
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
            $data = Student::findOrFail($request->id);
            $data->update([
                'is_active' => !$data->is_active,
                'updated_by' => auth('api')->id(),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Student disabled successfully',
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
            $data = Student::findOrFail($request->id);
            $data->delete();
            return response()->json([
                'status' => true,
                'message' => 'Student deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
