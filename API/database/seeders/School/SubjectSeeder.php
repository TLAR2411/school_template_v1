<?php

namespace Database\Seeders\School;

use App\Models\School\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'name_en' => "Math",
                'name_kh' => 'គណិតវិទ្យា',
                "symbol" => "M",
                'cur_id' => 2,
                "edu_id" => 3,
            ],
            [
                'name_en' => "Language Art",
                'name_kh' => 'ភាសា',
                "symbol" => "LA",
                'cur_id' => 1,
            ],
            [
                'name_en' => "Reading",
                'name_kh' => 'អាន',
                "symbol" => "R",
                'cur_id' => 1,
                'parent_id' => 2
            ],
            [
                'name_en' => "Listening",
                'name_kh' => 'ស្ដាប់',
                "symbol" => "L",
                'cur_id' => 1,
                'parent_id' => 2
            ],
            [
                'name_en' => "Writing",
                'name_kh' => 'សរសេរ',
                "symbol" => "W",
                'cur_id' => 1,
                'parent_id' => 2
            ],
            [
                'name_en' => "Speaking",
                'name_kh' => 'និយាយ',
                "symbol" => "R",
                'cur_id' => 1,
                'parent_id' => 2
            ]
        ];
        foreach ($data as $d) {
            Subject::create($d);
        }
    }
}
