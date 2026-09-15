<?php

namespace Database\Seeders\School;

use App\Models\School\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'name_en' => 'Monday',
                'short' => 'Mon',
                'name_kh' => 'ចន្ទ'
            ],
            [
                'name_en' => 'Tuesday',
                'short' => 'Tue',
                'name_kh' => 'អង្គារ'
            ],
            [
                'name_en' => 'Wednesday',
                'short' => 'Wed',
                'name_kh' => 'ពុធ'
            ],
            [
                'name_en' => 'Thursday',
                'short' => 'Thu',
                'name_kh' => 'ព្រហស្បតិ៍'
            ],
            [
                'name_en' => 'Friday',
                'short' => 'Fri',
                'name_kh' => 'សុក្រ'
            ],
            [
                'name_en' => 'Saturday',
                'short' => 'Sat',
                'name_kh' => 'សៅរ៍'
            ],
            // [
            //     'name_en' => 'Sunday',
            //     'short' => 'Sun',
            //     'name_kh' => 'អាទិត្យ'
            // ],

        ];

        foreach ($data as $d) {
            Day::create($d);
        }
    }
}
