<?php

namespace Database\Seeders\School;

use App\Models\School\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name_en' => 'Morning',
                'name_kh' => 'ព្រឹក',
                'code' => 'AM',
                'hour_start' => '07:00:00',
                'hour_end' => '11:00:00',
                'break_start' => null,
                'break_end' => null,
            ],
            [
                'name_en' => 'Afternoon',
                'name_kh' => 'រសៀល',
                'code' => 'PM',
                'hour_start' => '13:00:00',
                'hour_end' => '17:00:00',
                'break_start' => null,
                'break_end' => null,
            ],
            [
                'name_en' => 'Full Day',
                'name_kh' => 'ពេញថ្ងៃ',
                'code' => 'FULL',
                'hour_start' => '07:00:00',
                'hour_end' => '17:00:00',
                'break_start' => '11:00:00',
                'break_end' => '14:00:00', // lunch 11–2, then class 2–5
            ],
        ];

        foreach ($data as $d) {
            Shift::create($d);
        }
    }
}
