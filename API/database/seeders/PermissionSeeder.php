<?php

namespace Database\Seeders;

use App\Models\Auth\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    private $attributes = [
        'view',
        'add',
        'edit',
        'delete',
        'force-delete',
        'restore',
    ];

    private function insert($group, $attribute = null, $isAttribute = true)
    {
        if (!is_null($attribute)) {
            $attribute = array_unique(array_merge(($isAttribute == true ? $this->attributes : []), $attribute));
        } else {
            $attribute = ($isAttribute == true ? $this->attributes : []);
        }

        foreach ($attribute as $item) {
            Permission::firstOrCreate(
                ['name' => $item . '-' . $group],
                [
                    'group' => $group,
                    'display_name' => $item,
                ]
            );
        }
    }

    public function run(): void
    {
        $this->insert('allow-part', [
            'admin',
            'school',
        ], false);

        $this->insert('branches', ['change-active']);
        $this->insert('users', [
            'change-active',
            'change-password',
        ]);

        $this->insert('attendance', ['approve']);
        $this->insert('score-entry', ['approve']);

        $this->insert('activity-log');
        $this->insert('positions', ['change-active']);
        $this->insert('roles');
        $this->insert('permissions');
        $this->insert('villages');
        $this->insert('communes');
        $this->insert('districts');
        $this->insert('provinces');

        $this->insert('students', ['change-active', 'enroll']);
        $this->insert('teachers', ['change-active', 'import']);
        $this->insert('classes', ['change-active']);
        $this->insert('subjects', ['change-active']);
        $this->insert('families');
        $this->insert('schedules');
        $this->insert('attendance');
        $this->insert('score-entry');
        $this->insert('term-periods');
        $this->insert('curriculums', ['change-active']);
        $this->insert('years', ['change-active']);
        $this->insert('education-levels', ['change-active']);
        $this->insert('rooms', ['change-active']);
        $this->insert('grades', ['change-active']);
        $this->insert('teacher-classes');
        $this->insert('student-classes');
        $this->insert('grading-rules');
        $this->insert('assessments');
        $this->insert('subject-activity-types', ['change-active']);
    }
}
