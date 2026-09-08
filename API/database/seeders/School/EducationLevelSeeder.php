<?php

namespace Database\Seeders\School;

use Illuminate\Database\Seeder;
use App\Models\School\EducationLevel;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_en' => 'Primary',
                'name_kh' => 'បឋមសិក្សា',
                'symbol' => 'PR',
                'description' => '',
                'is_active' => true,
            ],
            [
                'name_en' => 'Secondary',
                'name_kh' => 'អនុវិទ្យាល័យ',
                'symbol' => 'S',
                'description' => '',
                'is_active' => true,
            ],
            [
                'name_en' => 'High School',
                'name_kh' => 'វិទ្យាល័យ',
                'symbol' => 'H',
                'description' => '',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            EducationLevel::create($item);
        }
    }
}
