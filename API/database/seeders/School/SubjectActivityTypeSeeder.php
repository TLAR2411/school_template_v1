<?php

namespace Database\Seeders\School;

use App\Models\School\SubjectActivityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_en' => 'Homework',
                'name_kh' => 'កិច្ចការផ្ទះ',
                'symbol' => 'H',
                'created_by' => 1
            ],
            [
                'name_en' => 'Work',
                'name_kh' => 'កិច្ចការសាលា',
                'symbol' => 'W',
                'created_by' => 1
            ],
            [
                'name_en' => 'Exam',
                'name_kh' => 'ប្រលង',
                'symbol' => 'E',
                'created_by' => 1
            ],
            [
                'name_en' => 'Attendance',
                'name_kh' => 'វត្តមាន',
                'symbol' => 'Att',
                'created_by' => 1
            ],
            [
                'name_en' => 'Participation',
                'name_kh' => 'ការចូលរួម',
                'symbol' => 'P',
                'created_by' => 1
            ],
        ];

        foreach ($data as $d) {
            SubjectActivityType::create($d);
        }
    }
}
