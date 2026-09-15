<?php

namespace Database\Seeders\School;

use App\Models\Auth\Role;
use App\Models\Auth\UserBranch;
use App\Models\School\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        // Optional: only if you have a teacher role
        $role = Role::where('name', 'teacher')->first()
            ?? Role::where('name', 'administration')->first();

        // --- Teacher 1: single branch ---
        $user1 = User::create([
            'name_kh' => 'ឡាយ លីណា',
            'name_en' => 'LAY LINA',
            'username' => 'lay.lina',
            'email' => 'lay.lina@school.test',
            'password' => Hash::make('Teacher@168'),
            'gender' => 'female',
            'dob' => '1995-01-15',
            'contact' => '012345678',
            'manage_branch' => 1,
            'branch_id' => 1,
            'role_id' => $role?->id,
            'is_active' => true,
            'join_date' => now(),
        ]);

        $user1->code = 'T-' . str_pad($user1->id, 6, '0', STR_PAD_LEFT);
        $user1->save();

        if ($role) {
            $user1->addRole($role);
        }

        Teacher::create([
            'user_id' => $user1->id,
            'name_kh' => 'ឡាយ លីណា',
            'name_en' => 'Lay Lina',
            'manage_branch' => 1,
            'nation' => 'kh',
            'gender' => 'female',
            'dob' => '1995-01-15',
            'phone' => '012345678',
            'cur_id' => 2,
            'is_active' => true,
            'created_by' => 1,
        ]);

        // --- Teacher 2: multiple branches (shows in both when switching) ---
        $user2 = User::create([
            'name_kh' => 'សុខ វិរៈ',
            'name_en' => 'SOK VIREAK',
            'username' => 'sok.vireak',
            'email' => 'sok.vireak@school.test',
            'password' => Hash::make('Teacher@168'),
            'gender' => 'male',
            'dob' => '1990-05-20',
            'contact' => '098765432',
            'manage_branch' => 2,
            'branch_id' => 1,
            'role_id' => $role?->id,
            'is_active' => true,
            'join_date' => now(),
        ]);

        $user2->code = 'T-' . str_pad($user2->id, 6, '0', STR_PAD_LEFT);
        $user2->save();

        if ($role) {
            $user2->addRole($role);
        }

        // branches this teacher belongs to
        foreach ([1, 2] as $branchId) {
            UserBranch::create([
                'user_id' => $user2->id,
                'branch_id' => $branchId,
            ]);
        }

        Teacher::create([
            'user_id' => $user2->id,
            'name_kh' => 'សុខ វិរៈ',
            'name_en' => 'Sok Vireak',
            'manage_branch' => 2,
            'nation' => 'kh',
            'gender' => 'male',
            'dob' => '1990-05-20',
            'phone' => '098765432',
            'cur_id' => 2,
            'is_active' => true,
            'created_by' => 1,
        ]);
    }
}