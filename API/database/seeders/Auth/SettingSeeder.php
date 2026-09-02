<?php

namespace Database\Seeders\Auth;

use App\Models\Core\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert = [
            [
                'name' => 'Company Name',
                'key' => 'company_name',
                'value' => 'Devfin Tech.'
            ],
            [
                'name' => 'Company Email',
                'key' => 'company_email',
                'value' => '@devfin.cc'
            ],
            [
                'name' => 'Default Password',
                'key' => 'default_password',
                'value' => 'Hello@332211'
            ],
            [
                'name' => 'Default Sub User Password',
                'key' => 'default_sub_user_password',
                'value' => Str::uuid()
            ]
        ];

        foreach ($insert as $key => $value) {
            Setting::create($value);
        }
    }
}
