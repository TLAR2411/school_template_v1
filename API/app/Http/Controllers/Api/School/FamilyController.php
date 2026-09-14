<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\School\FamilyResource;
use App\Models\Core\Setting;
use App\Models\School\Family;
use App\Models\School\FamilyMember;
use App\Models\School\StudentFamily;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Opcodes\LogViewer\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FamilyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string',
            'name_kh' => 'nullable|string',
            'description' => 'nullable|string',
            // At least 1 guardian
            'guardians' => 'required|array|min:1',
            'guardians.*.name_en' => 'required|string',
            'guardians.*.name_kh' => 'nullable|string',
            'guardians.*.type' => 'required|string',
            'guardians.*.phone' => 'nullable|string',
            'guardians.*.email' => 'nullable|email',
            'guardians.*.password' => 'nullable|string|min:6',
            // Student IDs are optional 
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'integer|exists:students,id',
        ]);
        try {
            $createdBy = auth('api')->id();
            DB::beginTransaction();
            $family = Family::create([
                'name_en' => $validated['name_en'],
                'name_kh' => $validated['name_kh'] ?? null,
                'description' => $validated['description'] ?? null,
                'created_by' => $createdBy,
            ]);

            //default password (ex: dewey@123)
            $defaultPassword = Cache::remember('setting_default_password', 86400, fn() => Setting::where('key', 'default_password')->value('value'));

            $companyEmail = Cache::remember('setting_company_name', 86400, function () {
                return Setting::where('key', 'company_email')->value('value');
            });


            foreach ($validated['guardians'] as $g) {

                // Example: // Tela → tela 
                // Dara Chan → dara.chan 
                // Teang Panha Tela → teang.panha.tela
                $nameParts = preg_split('/\s+/', Str::lower(trim($g['name_en'])));
                $lastName = end($nameParts);
                $username = implode('.', $nameParts);

                $password = $g['password'] ?? ($defaultPassword . $lastName);   //defaultpassword+lastname(dewey@tela)

                $email = $g['email'] ?? ($username . $companyEmail);

                $user = User::create([
                    'name_en' => Str::upper($g['name_en']),
                    'name_kh' => $g['name_kh'] ?? $g['name_en'],
                    'username' => $username,
                    'email' => $email,
                    'contact' => $g['phone'] ?? null,
                    'password' => Hash::make($password),
                    'is_active' => true,
                    'type' => 'main',
                    'created_by' => $createdBy,
                ]);

                FamilyMember::create([
                    'family_id' => $family->id,   // need this column
                    'user_id' => $user->id,       // need this column
                    'name_en' => $g['name_en'],
                    'name_kh' => $g['name_kh'] ?? null,
                    'type' => $g['type'],         // father / mother
                    'phone' => $g['phone'] ?? null,
                    'email' => $email,
                    'created_by' => $createdBy,
                ]);
            }

            foreach ($validated['student_ids'] ?? [] as $studentId) {
                StudentFamily::create([
                    'family_id' => $family->id,
                    'student_id' => $studentId,
                    'created_by' => $createdBy,
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Family created successfully',
                'created_by' => $createdBy,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 1
            ]);
        }
    }


    public function list(Request $request)
    {
        try {
            $data = Family::query()
                ->withCount([
                    'member as guardian_count',
                    'studentLink as student_count',
                ])
                ->filter($request->filter)
                ->latest('id')
                ->paginate($request->limit);
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 1
            ]);
        }
    }

    public function show(Request $request)
    {
        try {
            $data = Family::query()
                ->where('id', $request->id)
                ->with([
                    'studentLink.student',
                    'member.user',
                ])
                ->firstOrFail();

            // $data = FamilyResource::collection($data);

            return response()->json([
                'status' => true,
                'data' => new FamilyResource($data),
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
        $validated = $request->validate([
            'id' => 'required|integer|exists:families,id',
            'name_en' => 'required|string',
            'name_kh' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        try {
            $family = Family::query()->findOrFail($validated['id']);

            $family->update([
                'name_en' => $validated['name_en'],
                'name_kh' => $validated['name_kh'] ?? null,
                'description' => $validated['description'] ?? null,
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Family updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
