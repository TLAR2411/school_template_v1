<?php

namespace Database\Seeders\School;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                "name_kh" => "ទាង តេលា",
                "name_en" => "TEANG Tela",
                "gender" => "male",
                "dob" => "2026-01-01",
                "phone" => "0123456789",
                "email" => "telateang@example.com",
                "branch_id" => 1,
                "nation" => "Cambodian",
                "is_active" => true,
                "created_by" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name_kh" => "ឡាយ លីណា",
                "name_en" => "Lay Lina",
                "gender" => "female",
                "dob" => "2026-01-01",
                "phone" => "0123456789",
                "email" => "laylina@example.com",
                "branch_id" => 1,
                "nation" => "Cambodian",
                "is_active" => true,
                "created_by" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "name_kh" => "ឡាយ វិភូ",
                "name_en" => "Lay Viphou",
                "gender" => "male",
                "dob" => "2026-01-01",
                "phone" => "0123456789",
                "email" => "layviphou@example.com",
                "branch_id" => 1,
                "nation" => "Cambodian",
                "is_active" => true,
                "created_by" => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ];
        foreach ($data as $d) {
            Student::create($d);
        }
    }
}
