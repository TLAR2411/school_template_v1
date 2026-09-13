<?php

namespace Database\Seeders\School;

use App\Models\School\Teacher;
use App\Models\School\TeacherBranch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::create([
            'name_kh' => 'ឡាយ លីណា',
            'name_en' => 'Lay Lina',
            'manage_branch' => 1,
            'nation' => "kh",
            'gender' => 'female',
            'dob' => Date::now(),
            'created_by' => 1,
            'cur_id' => 2,
        ]);
        TeacherBranch::create([
            'teacher_id' => 1,
            'branch_id' => 1,
            'created_by' => 1
        ]);
    }
}
