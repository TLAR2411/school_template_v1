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
        Grade::create([
            'grade_level' => 1,
            // 'symbol'=>'ក',
            // 'name_kh'=>'1 ក',
            'edu_id' => 1,
            'cur_id' => 2,
            'branch_id' => 1,
            'is_active' => true

        ]);
    }
}
