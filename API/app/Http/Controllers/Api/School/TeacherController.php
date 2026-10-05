<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Teacher;
use App\Models\School\TeacherBranch;
use App\Models\School\TeacherClass;
use App\Models\School\Year;
use App\Models\Core\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\TeacherImportTemplateExport;
use App\Http\Resources\DataTableResource;
use App\Http\Resources\School\TeacherDetailResource;
use App\Models\Auth\Role;
use App\Models\Auth\UserBranch;
use App\Services\School\TeacherImportService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use App\Models\Core\Setting;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    public function store(Request $request)
    {


        $validate = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'required|string|max:255',
            'nation' => 'required|string|max:255',
            'photo_path' => 'nullable|string',
            'manage_branch' => 'required|in:1,2',
            // 'branch_id' => 'required_if:manage_branch,2|array|min:1',
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
                'email' => $lowerString . $companyName,
                'village_code' => $request->village_code,
                'default_part' => 'school',
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

    public function import(Request $request, TeacherImportService $service)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        if (! in_array($extension, ['xlsx', 'xls', 'csv'], true)) {
            return response()->json([
                'status' => false,
                'message' => 'Please upload an Excel file (.xlsx, .xls, .csv)',
            ], 422);
        }

        try {
            $result = $service->import($file->getRealPath(), [
                'branch_id' => $this->getBranch(),
                'cur_id' => $this->getCur(),
                'role_id' => $request->role_id,
                'created_by' => auth('api')->id(),
            ]);

            $message = "Imported {$result['created']} teacher(s)";
            if ($result['skipped']) {
                $message .= ", skipped {$result['skipped']}";
            }
            if ($result['failed']) {
                $message .= ", failed {$result['failed']}";
            }

            return response()->json([
                'status' => true,
                'message' => $message,
                'data' => $result,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function importTemplate()
    {
        return Excel::download(
            new TeacherImportTemplateExport(),
            'teacher-import-template.xlsx'
        );
    }

    public function list(Request $request)
    {
        try {
            $teacher = Teacher::query()
                ->withTelegramStatus()
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

    /**
     * Teacher profile + year-scoped class/subject assignments and branch coverage.
     */
    public function detail(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:teachers,id',
        ]);

        try {
            $yearId = $this->getYear();
            $teacher = Teacher::query()
                ->with(['user.branch:id,name_en,name_kh,abbr'])
                ->findOrFail($request->id);

            $branches = $this->resolveTeacherBranches($teacher);
            $classes = $this->buildTeacherClasses($teacher->id, $yearId);

            $classBranchIds = collect($classes)->pluck('branch_id')->filter()->unique()->values();
            $stats = [
                'class_total' => count($classes),
                'subject_total' => collect($classes)->sum(fn($c) => count($c['subjects'] ?? [])),
                'branch_total' => max(count($branches), $classBranchIds->count()),
                'classload_total' => collect($classes)->where('is_classload', true)->count(),
                'assistant_total' => collect($classes)->where('is_assisstant', true)->count(),
            ];

            $year = null;
            if ($yearId && $yearId !== '*') {
                $yearModel = Year::query()->select('id', 'name')->find($yearId);
                if ($yearModel) {
                    $year = ['id' => $yearModel->id, 'name' => $yearModel->name];
                }
            }

            return response()->json([
                'status' => true,
                'data' => new TeacherDetailResource($teacher, $branches, $classes, $stats, $year),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Branches the teacher belongs to (single user.branch or multi user_branches).
     */
    private function resolveTeacherBranches(Teacher $teacher): array
    {
        $user = $teacher->user;
        if (!$user) {
            return [];
        }

        if ((int) $teacher->manage_branch === 2) {
            $branchIds = UserBranch::where('user_id', $user->id)->pluck('branch_id');

            return Branch::query()
                ->whereIn('id', $branchIds)
                ->select('id', 'name_en', 'name_kh', 'abbr')
                ->orderBy('name_en')
                ->get()
                ->map(fn($b) => [
                    'id' => $b->id,
                    'name_en' => $b->name_en,
                    'name_kh' => $b->name_kh,
                    'abbr' => $b->abbr,
                ])
                ->values()
                ->all();
        }

        if ($user->branch) {
            return [[
                'id' => $user->branch->id,
                'name_en' => $user->branch->name_en,
                'name_kh' => $user->branch->name_kh,
                'abbr' => $user->branch->abbr,
            ]];
        }

        if ($user->branch_id) {
            $branch = Branch::query()
                ->select('id', 'name_en', 'name_kh', 'abbr')
                ->find($user->branch_id);

            if ($branch) {
                return [[
                    'id' => $branch->id,
                    'name_en' => $branch->name_en,
                    'name_kh' => $branch->name_kh,
                    'abbr' => $branch->abbr,
                ]];
            }
        }

        return [];
    }

    /**
     * Group teacher_class rows by class for the selected academic year.
     */
    private function buildTeacherClasses(int $teacherId, $yearId): array
    {
        $rows = TeacherClass::query()
            ->where('teacher_id', $teacherId)
            ->where('is_active', true)
            ->whereHas('class', function ($q) use ($yearId) {
                $q->where('is_active', true)
                    ->when($yearId && $yearId !== '*', fn($qq) => $qq->where('year_id', $yearId));
            })
            ->with([
                'subject:id,name_en,name_kh,symbol',
                'class:id,name_en,name_kh,symbol,grade_id,year_id,branch_id,room_id,shift_id,is_active',
                'class.grade:id,name_en,name_kh,grade_level',
                'class.branch:id,name_en,name_kh,abbr',
                'class.room:id,room_number',
                'class.shift:id,name_en,name_kh',
                'class.year:id,name',
            ])
            ->orderBy('class_id')
            ->get();

        return $rows
            ->groupBy('class_id')
            ->map(function ($items) {
                $first = $items->first();
                $class = $first->class;

                return [
                    'class_id' => $first->class_id,
                    'name_en' => $class?->name_en,
                    'name_kh' => $class?->name_kh,
                    'symbol' => $class?->symbol,
                    'year_id' => $class?->year_id,
                    'year_name' => $class?->year?->name,
                    'branch_id' => $class?->branch_id,
                    'branch_name_en' => $class?->branch?->name_en,
                    'branch_name_kh' => $class?->branch?->name_kh,
                    'branch_abbr' => $class?->branch?->abbr,
                    'grade_level' => $class?->grade?->grade_level,
                    'grade_name_en' => $class?->grade?->name_en,
                    'grade_name_kh' => $class?->grade?->name_kh,
                    'room_number' => $class?->room?->room_number,
                    'shift_name_en' => $class?->shift?->name_en,
                    'shift_name_kh' => $class?->shift?->name_kh,
                    'is_classload' => (bool) $items->contains('is_classload', true),
                    'is_assisstant' => (bool) $items->contains('is_assisstant', true),
                    'subjects' => $items->map(fn($row) => [
                        'id' => $row->id,
                        'subject_id' => $row->subject_id,
                        'name_en' => $row->subject?->name_en,
                        'name_kh' => $row->subject?->name_kh,
                        'symbol' => $row->subject?->symbol,
                        'is_classload' => (bool) $row->is_classload,
                        'is_assisstant' => (bool) $row->is_assisstant,
                    ])->values()->all(),
                ];
            })
            ->sortBy(fn($c) => $c['name_en'] ?? $c['name_kh'] ?? '')
            ->values()
            ->all();
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
