<?php

namespace App\Http\Controllers\Api\School;


use App\Http\Controllers\Controller;
use App\Models\Core\Setting;
use App\Models\School\FamilyMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Opcodes\LogViewer\Facades\Cache;

class FamilyMemberController extends Controller
{
    public function show(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:family_members,id',
            ]);

            $member = FamilyMember::query()
                ->with('user:id,username,email,contact')
                ->findOrFail($request->id);

            return response()->json([
                'status' => true,
                'data' => [
                    'id' => $member->id,
                    'family_id' => $member->family_id,
                    'type' => $member->type,
                    'name_en' => $member->name_en,
                    'name_kh' => $member->name_kh,
                    'phone' => $member->phone ?? $member->user?->contact,
                    'email' => $member->email ?? $member->user?->email,
                    'description' => $member->description,
                    'user_id' => $member->user_id,
                    'user' => $member->user ? [
                        'id' => $member->user->id,
                        'username' => $member->user->username,
                        'email' => $member->user->email,
                        'contact' => $member->user->contact,
                    ] : null,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'family_id' => 'required|integer|exists:families,id',
            'type' => 'required|string',
            'name_en' => 'required|string',
            'name_kh' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string|min:6',
            'description' => 'nullable|string',
        ]);
        try {
            $createdBy = auth('api')->id();
            $defaultPassword = Cache::remember(
                'setting_default_password',
                86400,
                fn() => Setting::where('key', 'default_password')->value('value')
            );
            $companyEmail = Cache::remember(
                'setting_company_email',
                86400,
                fn() => Setting::where('key', 'company_email')->value('value')
            );
            DB::beginTransaction();
            $nameParts = preg_split('/\s+/', Str::lower(trim($validated['name_en'])));
            $lastName = end($nameParts);
            $username = implode('.', $nameParts);
            $password = $validated['password'] ?? ($defaultPassword . $lastName);
            $email = $validated['email'] ?? ($username . $companyEmail);
            $user = User::create([
                'name_en' => Str::upper($validated['name_en']),
                'name_kh' => $validated['name_kh'] ?? $validated['name_en'],
                'username' => $username,
                'email' => $email,
                'contact' => $validated['phone'] ?? null,
                'password' => Hash::make($password),
                'is_active' => true,
                'type' => 'main',
                'created_by' => $createdBy,
            ]);
            FamilyMember::create([
                'family_id' => $validated['family_id'],
                'user_id' => $user->id,
                'name_en' => $validated['name_en'],
                'name_kh' => $validated['name_kh'] ?? null,
                'type' => $validated['type'],
                'phone' => $validated['phone'] ?? null,
                'email' => $email,
                // 'description' => $validated['description'] ?? null, // only if column exists
                'created_by' => $createdBy,
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Family member created successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:family_members,id',
            'type' => 'required|string',
            'name_en' => 'required|string',
            'name_kh' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'description' => 'nullable|string',
        ]);
        try {
            $updatedBy = auth('api')->id();
            DB::beginTransaction();
            $member = FamilyMember::query()->findOrFail($validated['id']);
            $email = $validated['email'] ?? $member->email;
            $member->update([
                'type' => $validated['type'],
                'name_en' => $validated['name_en'],
                'name_kh' => $validated['name_kh'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'email' => $email,
                'updated_by' => $updatedBy,
            ]);
            if ($member->user_id) {
                User::where('id', $member->user_id)->update([
                    'name_en' => Str::upper($validated['name_en']),
                    'name_kh' => $validated['name_kh'] ?? $validated['name_en'],
                    'email' => $email,
                    'contact' => $validated['phone'] ?? null,
                    'updated_by' => $updatedBy,
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Family member updated successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:family_members,id',
        ]);
        try {
            DB::beginTransaction();
            $member = FamilyMember::query()->findOrFail($validated['id']);
            $userId = $member->user_id;
            // delete member first
            $member->delete();
            // then delete linked user (if any)
            if ($userId) {
                User::where('id', $userId)->delete();
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Family member deleted successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
