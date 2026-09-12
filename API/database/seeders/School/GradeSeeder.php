<?php

namespace Database\Seeders\School;

use App\Models\School\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'grade_level' => 1,
                'edu_id' => 1,
                'cur_id' => 2,
                'branch_id' => 1,
                'is_active' => true
            ],
            [
                'name_en' => 'Nursery',
                'name_kh' => 'មត្តេយ្យ',
                'cur_id' => 1,
                'branch_id' => 1,
                'is_active' => true

            ]
        ];
        foreach ($data as $d) {
            Grade::create($d);
        }
    }
}
