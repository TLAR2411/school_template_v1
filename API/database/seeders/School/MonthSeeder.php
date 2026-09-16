<?php

namespace Database\Seeders\School;

use App\Models\School\Month;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_en' => 'January',
                'code' => 'Jan',
                'name_kh' => 'មករា'
            ],
            [
                'name_en' => 'February',
                'code' => 'Feb',
                'name_kh' => 'កុម្ផៈ'
            ],
            [
                'name_en' => 'March',
                'code' => 'Mar',
                'name_kh' => 'មិនា'
            ],
            [
                'name_en' => 'April',
                'code' => 'Apr',
                'name_kh' => 'មេសា'
            ],
            [
                'name_en' => 'May',
                'code' => 'May',
                'name_kh' => 'ឧសភា'
            ],
            [
                'name_en' => 'June',
                'code' => 'Jun',
                'name_kh' => 'មិថុនា'
            ],
            [
                'name_en' => 'July',
                'code' => 'Jul',
                'name_kh' => 'កក្កដា'
            ],
            [
                'name_en' => 'August',
                'code' => 'Aug',
                'name_kh' => 'សីហា'
            ],
            [
                'name_en' => 'September',
                'code' => 'Sep',
                'name_kh' => 'កញ្ញា'
            ],
            [
                'name_en' => 'October',
                'code' => 'Oct',
                'name_kh' => 'តុលា'
            ],
            [
                'name_en' => 'November',
                'code' => 'Nov',
                'name_kh' => 'វិច្ឋិកា'
            ],
            [
                'name_en' => 'December',
                'code' => 'Dec',
                'name_kh' => 'ធ្នូ'
            ]
        ];

        foreach ($data as $d) {
            Month::create($d);
        }
    }
}
