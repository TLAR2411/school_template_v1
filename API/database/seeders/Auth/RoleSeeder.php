<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $insert = [
            ['name' => 'developer',  'display_name' => 'Developer',  'abbr' => 'DEV'],
            ['name' => 'superadmin', 'display_name' => 'Superadmin', 'abbr' => 'SADMIN'],
            ['name' => 'admin',      'display_name' => 'Admin',      'abbr' => 'ADMIN'],
            ['name' => 'teacher',    'display_name' => 'Teacher',    'abbr' => 'TEACHER'],
            ['name' => 'staff',      'display_name' => 'Staff',      'abbr' => 'STAFF'],
        ];

        foreach ($insert as $value) {
            Role::firstOrCreate(['name' => $value['name']], $value);
        }

        $all = Permission::all();

        Role::where('name', 'developer')->first()
            ?->syncPermissions($all);

        Role::where('name', 'superadmin')->first()
            ?->syncPermissions($all->where('group', '!=', 'permissions'));

        $adminGroups = [
            'allow-part',
            'users',
            'positions',
            'branches',
            'activity-log',
            'villages',
            'communes',
            'districts',
            'provinces',
            'students',
            'teachers',
            'classes',
            'subjects',
            'families',
            'schedules',
            'attendance',
            'score-entry',
            'term-periods',
            'curriculums',
            'years',
            'education-levels',
            'rooms',
            'grades',
            'teacher-classes',
            'student-classes',
            'grading-rules',
            'assessments',
            'subject-activity-types',
        ];

        Role::where('name', 'admin')->first()?->syncPermissions(
            $all->whereIn('group', $adminGroups)
                ->whereNotIn('display_name', ['force-delete', 'restore'])
        );

        $this->syncByNames('teacher', [
            'school-allow-part',
            'view-classes',
            'add-attendance',
            'edit-attendance',
            'add-score-entry',
            'edit-score-entry',
        ]);

        $this->syncByNames('staff', [
            'school-allow-part',
            'view-students',
            'add-students',
            'edit-students',
            'enroll-students',
            'change-active-students',
            'view-families',
            'add-families',
            'edit-families',
            'view-classes',
            'view-teachers',
            'view-schedules',
            'view-attendance',
            'add-attendance',
            'view-student-classes',
            'add-student-classes',
            'edit-student-classes',
        ]);
    }

    private function syncByNames(string $roleName, array $permissionNames): void
    {
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            return;
        }

        $role->syncPermissions(
            Permission::whereIn('name', $permissionNames)->get()
        );
    }
}
