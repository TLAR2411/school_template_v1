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
            Permission::create([
                'name' => $item . '-' . $group,
                'group' => $group,
                'display_name' => $item,
            ]);
        }
    }

    public function run(): void
    {
        $this->insert('allow-part', [
            'loan',
            'accounting',
            'hr',
            'admin',
        ], false);

        $this->insert('branches');
        $this->insert('users', [
            'change-active',
            'change-password',
        ]);
        $this->insert('activity-log');
        $this->insert('positions');
        $this->insert('roles');
        $this->insert('permission');
        $this->insert('villages');
        $this->insert('communes');
        $this->insert('districts');
        $this->insert('provinces');
    }
}
