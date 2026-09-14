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
                'value' => 'Dewey International School'
            ],
            [
                'name' => 'Company Email',
                'key' => 'company_email',
                'value' => '@diu.edu.kh'
            ],
            [
                'name' => 'Default Password',
                'key' => 'default_password',
                'value' => 'dewey@123'
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
