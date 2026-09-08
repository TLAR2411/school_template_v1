<?php

namespace Database\Seeders\School;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School\Curriculum;
class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [[
            "name_en" => "English Curriculum",
            "name_kh" => "កម្មវិធីសិក្សា អង់គ្លេស",
            "symbol" => "ENG",
            "created_by" => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ],
        [
            "name_en" => "Khmer Curriculum",
            "name_kh" => "កម្មវិធីសិក្សា ខ្មែរ",
            "symbol" => "KH",   
            "created_by" => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ],
        ];
        foreach ($datas as $data) {
            Curriculum::create($data);
        }
    }
}
