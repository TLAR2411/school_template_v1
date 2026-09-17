<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Teacher;
use App\Models\School\TeacherBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DataTableResource;
use App\Models\Auth\Role;
use App\Models\Auth\UserBranch;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\Core\Setting;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
            'manage_branch' => 'required|in:1,2',
            'branch_id' => 'required_if:manage_branch,2|array|min:1',
            'branch_id.*' => 'integer|exists:branches,id',
            'role_id' => 'nullable|exists:roles,id', // teacher role
            'phone' => 'nullable|string',
        ]);
        try {
            DB::beginTransaction();

            $currentBranchId = $this->getBranch();
            $branchIds = $validate['manage_branch'] == 2
                ? $validate['branch_id']
                : [$currentBranchId];

            // --- create user (same style as UserController) ---
            $companyName = Cache::remember('setting_company_name', 86400, function () {
                return Setting::where('key', 'company_email')->value('value');
            });
            $nameParts = preg_split('/\s+/', Str::lower(trim($validate['name_en'])));
            $lowerString = implode('.', $nameParts);

            $defaultPassword = Cache::remember(
                'setting_default_password_' . $lowerString,
                86400,
                function () use ($lowerString) {
                    return Setting::where('key', 'default_password')->value('value') . $lowerString;
                }
            );

            $user = User::create([
                'name_kh' => $validate['name_kh'],
                'name_en' => Str::upper($validate['name_en']),
                'gender' => $validate['gender'],
                'dob' => Carbon::parse($validate['dob'])->format('Y-m-d'),
                'contact' => $request->phone,
                'manage_branch' => $validate['manage_branch'],
                'branch_id' => $currentBranchId,
                'role_id' => $request->role_id, // or hardcode teacher role id
                'password' => Hash::make($defaultPassword),
                'username' => 'default',
                'is_active' => true,
                'village_code' => $request->village_code,
            ]);
            $user->code = 'T' . '-' . str_pad($user->id, 6, '0', STR_PAD_LEFT);
            $user->username = $lowerString;
            $user->save();
            if ($request->role_id) {
                $role = Role::findOrFail($request->role_id);
                if ($role) {
                    $user->addRole($role);
                }
            }
            if ($validate['manage_branch'] == 2) {
                foreach ($branchIds as $id) {
                    UserBranch::create([
                        'user_id' => $user->id,
                        'branch_id' => $id,
                    ]);
                }
            }

            // --- create teacher linked to user ---
            $teacher = Teacher::create([
                'user_id' => $user->id,
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
                'cur_id' => $this->getCur(),
                'photo_path' => $request->photo_path
                    ? 'storage/' . $this->storeImage($request->photo_path, 'teachers/images')
                    : null,
                'created_by' => auth('api')->id(),
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Teacher created successfully',
                'status' => true,
                'default_password' => $defaultPassword,
                'username' => $user->username,
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
            $data = Teacher::with(['user.userBranch']) // add these relations on models
                ->findOrFail($request->id);
            // flatten for frontend edit form
            $data->user_branches = $data->user
                ? UserBranch::where('user_id', $data->user_id)->get(['user_id', 'branch_id'])
                : collect();
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
            // sync linked user + user_branches (no teacher_branches)
            if ($teacher->user_id) {
                $user = User::findOrFail($teacher->user_id);
                $user->update([
                    'name_kh' => $validate['name_kh'],
                    'name_en' => Str::upper($validate['name_en']),
                    'gender' => $validate['gender'],
                    'dob' => Carbon::parse($validate['dob'])->format('Y-m-d'),
                    'contact' => $request->phone,
                    'manage_branch' => $validate['manage_branch'],
                    'village_code' => $request->village_code,
                ]);
                UserBranch::where('user_id', $user->id)->delete();
                if ($validate['manage_branch'] == 2) {
                    foreach ($validate['branch_id'] as $id) {
                        UserBranch::create([
                            'user_id' => $user->id,
                            'branch_id' => $id,
                        ]);
                    }
                }
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
