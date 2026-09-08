<?php

namespace Database\Seeders\School;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\School\Year;
class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [[
            "name" => "2026 - 2027",
            "start_date" => "2026-01-01",
            "end_date" => "2026-12-31",
            "created_at" => now(),
            "updated_at" => now(),
        ],
        [
            "name" => "2027 - 2028",
            "start_date" => "2027-01-01",
            "end_date" => "2027-12-31",
            "created_at" => now(),
            "updated_at" => now(),
        ],
        ];
        foreach ($datas as $data) {
            Year::create($data);
        }
    }
}
