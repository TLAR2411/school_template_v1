<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UserPasswordRequest;
use App\Http\Resources\DataTableResource;
use App\Models\Address\Commune;
use App\Models\Address\District;
use App\Models\Address\Province;
use App\Models\Address\Village;
use App\Models\Auth\PermissionUser;
use App\Models\Auth\Role;
use App\Models\Auth\UserBranch;
use App\Models\Core\Branch;
use App\Models\Core\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function all(Request $request)
    {
        $users = User::query()
            ->leftJoin('roles as r', 'users.role_id', 'r.id')
            ->leftJoin('positions as p', 'users.position_id', 'p.id')
            ->select([
                'users.id',
                'users.name_kh',
                'users.name_en',
                'users.gender',
                'r.display_name',
                'r.abbr as role_abbr',
                'p.name_kh as position_name',
                'p.abbr as position_abbr',
                'p.level as position_level',
            ])
            ->when($this->getBranch() != '*', function ($q) use ($request) {
                return $q->where('users.branch_id', $this->getBranch());
            })
            ->where('users.is_active', true)
            ->orderByDesc('p.level')
            ->get();
        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    public function allUnderUsers(Request $request)
    {
        $users = User::query()
            ->leftJoin('roles as r', 'users.role_id', 'r.id')
            ->leftJoin('positions as p', 'users.position_id', 'p.id')
            ->leftJoin('branches as b', 'users.branch_id', 'b.id')
            ->select([
                'users.id',
                'users.name_kh',
                'users.name_en',
                'users.gender',
                'users.image_path',
                'users.contact',
                'r.display_name',
                'r.abbr as role_abbr',
                'p.name_kh as position_name',
                'p.abbr as position_abbr',
                'p.level as position_level',
            ])
            ->where('p.level', ">=", 20)
            ->where('users.is_active', true)
            ->where('users.id', '!=', 1)
            ->when($request->choose_branch_id != '*', function ($q) use ($request) {
                return $q->where('b.id', $request->choose_branch_id)
                    ->orWhere('b.is_head', true);
            })
            ->orderByDesc('p.level')
            ->get();
        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    public function show(Request $request)
    {
        try {
            $users = User::with([
                'userBranch',
            ])->findOrFail($request->id);

            $userPermssion = PermissionUser::where("user_id", $request->id)
                ->select([
                    'permission_id as id',
                ])
                ->get();

            $village = Village::where('code', $users->village_code ?? null)->first();
            $commune = Commune::where('code', $village->commune_code ?? null)->first();
            $district = District::where('code', $commune->district_code ?? null)->first();
            $province = Province::where('code', $district->province_code ?? null)->first();

            $users['village_code'] = $village['code'] ?? null;
            $users['commune_code'] = $commune['code'] ?? null;
            $users['district_code'] = $district['code'] ?? null;
            $users['province_code'] = $province['code'] ?? null;

            $users['user_permission'] = $userPermssion;

            return response()->json([
                'status' => true,
                'data' => $users
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $users = User::query()
                ->with([
                    'branch',
                    'role',
                    'position',
                    'underUser'
                ])
                ->whereBranch($this->getBranch())
                ->filter($request->filter)
                ->when(!Auth::user()->is_super, function ($query) {
                    return $query->where('username', '!=', 'admin');
                })
                ->orderByDesc("id")
                ->paginate($request->limit);
            $users = DataTableResource::collection($users)->response()->getData(true);
            return response()->json([
                'status' => true,
                'data' => $users
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        $userData = [];
        DB::beginTransaction();
        try {

            $companyName = Cache::remember('setting_company_name', 86400, function () {
                return Setting::where('key', 'company_email')->value('value');
            });

            $defaultPassword = Cache::remember('setting_default_password', 86400, function () {
                return Setting::where('key', 'default_password')->value('value');
            });


            $lowerName = Str::lower($request->name_en);
            $name = explode(" ", $lowerName);

            $userData = $request->all();
            $userData['name_en'] = Str::upper($request->name_en);
            $userData['dob'] = Carbon::parse($userData['dob'])->format('Y-m-d');
            $userData['join_date'] = $userData['join_date'] ? Carbon::parse($userData['join_date'])->format('Y-m-d') : null;
            $userData['password'] = Hash::make($defaultPassword);
            $userData['username'] = 'default';
            $userData['branch_id'] = $request->choose_branch_id;

            $users = User::create($userData);
            $branch = Branch::findOrFail($request->choose_branch_id);

            $lowerString = $name[1] ? $name[1] . $users->id : $name[0] . $users->id;

            $users->code = $branch->abbr . "-" . str_pad($users->id, 6, '0', STR_PAD_LEFT);

            $users->email = $lowerString . $companyName;
            $users->username = $lowerString;
            $users->save();

            $role = Role::find($request->role_id);
            $users->addRole($role);

            $userData['user_id'] = $users->id;

            if ($userData['manage_branch'] == 2 || $userData['manage_branch'] == 4) {
                foreach ($userData['_branch_id'] as $branch_id) {
                    UserBranch::create([
                        'user_id' => $userData['user_id'],
                        'branch_id' => $branch_id
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Successful Created User!"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $users = User::findOrFail($request->id);

            $users->update([
                'branch_id' => $request->choose_branch_id,
                'name_kh' => $request->name_kh,
                'name_en' => Str::upper($request->name_en),
                'manage_branch' => $request->manage_branch,
                'under_user_id' => $request->under_user_id,
                'position_id' => $request->position_id,
                'role_id' => $request->role_id,
                'gender' => $request->gender,
                'dob' => $request->dob ? Carbon::parse($request->dob)->format('Y-m-d') : null,
                'join_date' => $request->join_date ? Carbon::parse($request->join_date)->format('Y-m-d') : null,
                'contact' => $request->contact,
                'village_code' => $request->village_code,
                'national_id_number' => $request->national_id_number,
                'national_id_issue_date' => $request->national_id_issue_date ? Carbon::parse($request->national_id_issue_date)->format('Y-m-d') : null,
            ]);

            $users->syncRoles([$request->role_id]);

            if ($request->manage_branch == 2 || $request->manage_branch == 4) {

                UserBranch::where('user_id', $request->id)->delete();

                foreach ($request->_branch_id as $branch_id) {
                    UserBranch::create([
                        'user_id' => $request->id,
                        'branch_id' => $branch_id
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Successful Updated User!"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            User::findOrFail($request->id)->delete();

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Successful Deleted User!"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function disable(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            $user->is_active = $user->is_active == true ? false : true;
            $user->save();

            $user->tokens()->update(['revoked' => true]);

            return response()->json([
                'status' => true,
                'message' => $user->is_active == 1 ? "Successful Opened User!" : "Successful Disabled User!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function password(UserPasswordRequest $request)
    {
        try {
            $user = User::findOrFail(Auth::id());

            if (!Hash::check($request->old_password, $user->password)) {
                abort(500, 'Old Password is incorrect!');
            }

            $user->password = bcrypt($request->new_password);
            $user->save();

            return response()->json([
                'status' => true,
                'message' => "Successful Change Password User!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getCo(Request $request)
    {
        $users = User::query()
            ->leftJoin('roles as r', 'users.role_id', 'r.id')
            ->leftJoin('positions as p', 'users.position_id', 'p.id')
            ->leftJoin('users as u', 'u.id', 'users.under_user_id')
            ->select([
                'users.id',
                'users.name_kh',
                'users.name_en',
                'users.gender',
                'r.display_name',
                'r.abbr as role_abbr',
                'p.name_kh as position_name',
                'p.abbr as position_abbr',
                'u.name_kh as user_group',
                'users.image_path as image_path',
                'users.contact as contact',
            ])
            ->when($this->roleCCO(), function ($query) {
                return $query->join('users as uu', 'uu.id', 'users.id')
                    ->where('uu.under_user_id', Auth::id());
            })
            ->where('p.is_member', true)
            ->whereBranch($this->getBranch())
            ->where('users.is_active', true)
            ->get();
        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    public function getApprover(Request $request)
    {
        $users = User::query()
            ->leftJoin('roles as r', 'users.role_id', 'r.id')
            ->leftJoin('positions as p', 'users.position_id', 'p.id')
            ->select([
                'users.id as user_id',
                'users.name_kh',
                'users.name_en',
                'users.gender',
                'users.branch_id',
                'r.display_name',
                'r.abbr as role_abbr',
                'p.name_kh as position_name',
                'p.abbr as position_abbr',
                'p.level as position_level',
                'users.image_path as image_path',
                'users.contact as contact',
            ])
            ->when($this->getBranch() != '*', function ($query) {
                $currentBranch = $this->getBranch();
                // Optimization: Get ID directly
                $headBranchId = Branch::where('is_head', true)->value('id');
                return $query->where(function ($qq) use ($currentBranch, $headBranchId) {
                    $qq->where('users.branch_id', $currentBranch)
                        ->orWhere(function ($mQ) use ($headBranchId, $currentBranch) {
                            $mQ->where(function ($managerQ) use ($currentBranch) {
                                $managerQ->where('users.manage_branch', 2)
                                    ->whereExists(function ($existsQ) use ($currentBranch) {
                                        $existsQ->select(DB::raw(1))
                                            ->from('user_branches')
                                            ->whereColumn('user_branches.user_id', 'users.id')
                                            ->where('user_branches.branch_id', $currentBranch);
                                    });
                            })->orWhere(function ($managerQ) use ($currentBranch) {
                                $managerQ->where('users.manage_branch', 3);
                            });
                        });

                });
            })
            ->where('p.department_id', 2)
            ->where('p.is_member', false)
            ->where('p.level', '>', 20)
            ->where('users.is_active', true)
            ->orderBy('p.level')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $users
        ]);
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|string|min:8',
            ]);

            $user = User::findOrFail($request->id);

            $user->password = bcrypt($request->password);

            $user->save();

            return response()->json([
                'status' => true,
                'message' => "Successful Change Password User!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function changeUsernameEmail(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
            ]);

            $user = User::findOrFail($request->id);

            $user->username = $request->username;
            $user->email = $request->email;

            $user->save();

            return response()->json([
                'status' => true,
                'message' => "Successful Change Username&Email User!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function permission(Request $request)
    {
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*.id' => 'nullable|exists:permissions,id',
        ]);
        DB::beginTransaction();
        try {
            $user = User::findOrFail($request->id);

            $permissions = array_values($request->permissions);
            // Filter out invalid values
            $permissions = array_filter($permissions, function ($value) {
                return is_int($value) || is_string($value);
            });
            $user->permissions()->sync($permissions);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => "Successful Change Permission!"
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function changeImagePath(Request $request)
    {
        try {

            User::findOrFail(Auth::id())->update([
                'image_path' => $request->image_path ? 'storage/' . $this->storeImage($request->image_path, 'users/images') : null
            ]);

            return response()->json([
                'status' => true,
                'message' => "Successful Change Image!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function linkUser(Request $request)
    {
        DB::beginTransaction();
        try {

            $findUser = User::findOrFail($request->id);
            $companyName = Cache::remember('setting_company_name', 86400, function () {
                return Setting::where('key', 'company_email')->value('value');
            });
            $defaultSubUserPassword = Cache::remember('setting_default_password', 86400, function () {
                return Setting::where('key', 'default_password')->value('value');
            });
            $username = Str::uuid();

            $insert = [
                'branch_id' => $request->branch_id,
                'manage_branch' => $request->manage_branch,
                'role_id' => $request->role_id,
                'position_id' => $request->position_id,


                'name_kh' => $findUser->name_kh,
                'name_en' => $findUser->name_en,
                'gender' => $findUser->gender,
                'dob' => $findUser->dob,

                'contact' => $findUser->contact,
                'parent_user_id' => $findUser->id,
                'join_date' => $findUser->join_date,
                'under_user_id' => $findUser->under_user_id,
                'type' => 'sub',
                'username' => $username,
                'email' => Str::random(8) . "@" . $companyName,
                'password' => Hash::make($defaultSubUserPassword),
            ];

            $user = User::create($insert);
            $role = Role::find($request->role_id);
            $user->addRole($role);

            $branch = Branch::find($request->branch_id);

            $user->code = $branch->abbr . '-' . str_pad($user->id, 6, '0', STR_PAD_LEFT);
            $user->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'data' => $insert,
                'message' => "Successful Change Link!"
            ]);


        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
