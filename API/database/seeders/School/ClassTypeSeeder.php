<?php

namespace Database\Seeders\School;

use App\Models\School\ClassType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_en' => "Scient",
                'name_kh' => 'វិទ្យាសាស្រ្ត',
                'created_by' => 1
            ],
            [
                'name_en' => "Social",
                'name_kh' => 'វិទ្យាសង្គម',
                'created_by' => 1
            ],

        ];

        foreach ($data as $d) {
            ClassType::create($d);
        }
    }
}
