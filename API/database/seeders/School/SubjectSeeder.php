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
        Subject::create([
            'name_en' => "Math",
            'name_kh' => 'គណិតវិទ្យា',
            "symbol" => "M",
            'cur_id' => 2,
            "edu_id" => 3,
        ]);
    }
}
