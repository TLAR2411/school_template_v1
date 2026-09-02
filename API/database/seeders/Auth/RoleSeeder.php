<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'name' => 'developer',
                'display_name' => 'Developer',
                'abbr' => 'DEV'
            ],
            [
                'name' => 'system-administrator',
                'display_name' => 'System Administrator',
                'abbr' => 'SYS'
            ],
            [
                'name' => 'chief-executive-officer',
                'display_name' => 'អគ្គនាយក',
                'abbr' => 'CEO'
            ],
            [
                'name' => 'board-of-directors',
                'display_name' => 'ក្រុមប្រឹក្សាភិបាល',
                'abbr' => 'BOD'
            ],
            [
                'name' => 'operation-manager',
                'display_name' => 'ប្រធាននាយកដ្ឋានប្រតិបត្តិការ',
                'abbr' => 'COO'
            ],
            [
                'name' => 'chief-financial-Officer',
                'display_name' => 'ប្រធាននាយកដ្ឋានហិរញ្ញវត្ថុ',
                'abbr' => 'CFO'
            ],
            [
                'name' => 'human-resource-manager',
                'display_name' => 'ប្រធាននាយកដ្ឋានធនធានមនុស្ស',
                'abbr' => 'HHR'
            ],
            [
                'name' => 'audit-manager',
                'display_name' => 'ប្រធាននាយកដ្ឋានសវនកម្ម',
                'abbr' => 'HOA'
            ],
            [
                'name' => 'marketing-manager',
                'display_name' => 'ប្រធាននាយកដ្ឋានទីផ្សារ',
                'abbr' => 'HOM'
            ],
            [
                'name' => 'invester',
                'display_name' => 'អ្នកវិនិយោគ',
                'abbr' => 'INV'
            ],
            [
                'name' => 'regional-manager',
                'display_name' => 'ប្រធានភូមិភាគ',
                'abbr' => 'RM'
            ],
            [
                'name' => 'branch-manager',
                'display_name' => 'ប្រធានសាខា',
                'abbr' => 'BM'
            ],
            [
                'name' => 'branch-supervisor',
                'display_name' => 'អ្នកមើលការខុសត្រូវក្នុងសាខា',
                'abbr' => 'BS'
            ],
            [
                'name' => 'chief-credit-officer',
                'display_name' => 'ប្រធានមន្ត្រីឥណទាន',
                'abbr' => 'CCO'
            ],
            [
                'name' => 'credit-officer',
                'display_name' => 'មន្ត្រីឥណទាន',
                'abbr' => 'CO',
            ],
            [
                'name' => 'chief-teller',
                'display_name' => 'ប្រធានបេឡា',
                'abbr' => 'CT',
            ],
            [
                'name' => 'teller',
                'display_name' => 'បេឡា',
                'abbr' => 'TEL',
            ],
            [
                'name' => 'administration',
                'display_name' => 'រដ្ឋបាល',
                'abbr' => 'ADMIN'
            ],
            [
                'name' => 'auditor',
                'display_name' => 'មន្រ្តីសវនករ',
                'abbr' => 'AUD'
            ],
            [
                'name' => 'debt-manager',
                'display_name' => 'ប្រធាននាយកដ្ឋានគ្រប់គ្រងបំណុល',
                'abbr' => 'DBTM'
            ],
            [
                'name' => 'debt-officer',
                'display_name' => 'មន្រ្ដីដោះស្រាយបំណុល',
                'abbr' => 'DBTO'
            ]
        ];

        foreach ($insert as $value) {
            Role::create($value);
        }

        $role = Role::where('name', 'developer')->first();
        $role->syncPermissions(Permission::all());
    }
}
