<?php

namespace Database\Seeders\Core;

use App\Models\Core\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $insert = [
//            [
//                'name_kh' => 'ការិយាល័យកណ្តាល',
//                'name_en' => 'Head Office',
//                'abbr' => 'HO',
//                'is_head' => true,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាបាត់ដំបង',
//                'name_en' => 'Battambang Branch',
//                'abbr' => 'BTB',
//                'start_date' => now()
//            ]
//
//        ];
        // $insert = [
        //     'name_kh' => 'ការិយាល័យកណ្តាល',
        //     'name_en' => 'Head Office',
        //     'abbr' => 'HO',
        //     'is_head' => true,
        //     'start_date' => now()
        // ];


//        $insert = [
//            [
//                'name_kh' => 'សាខាបាត់ដំបង',
//                'name_en' => 'Battambang',
//                'abbr' => 'BTB',
//                'region' => 2,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកអូរជ្រៅ',
//                'name_en' => 'Ochrov District',
//                'abbr' => 'OCH',
//                'is_head' => false,
//                'region' => 3,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកមង្គលបូរី',
//                'name_en' => 'Mongkol Borey District',
//                'abbr' => 'MKB',
//                'is_head' => false,
//                'region' => 3,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកថ្មពួក',
//                'name_en' => 'Thma Puok District',
//                'abbr' => 'TMP',
//                'is_head' => false,
//                'region' => 4,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តកំពង់ចាម',
//                'name_en' => 'Kampong Cham',
//                'abbr' => 'KCH',
//                'is_head' => false,
//                'region' => 1,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តពោធិ៍សាត់',
//                'name_en' => 'Pursat',
//                'abbr' => 'PST',
//                'is_head' => false,
//                'region' => 2,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកកំពង់ត្រឡាច',
//                'name_en' => 'Kampong Tralach District',
//                'abbr' => 'KTL',
//                'is_head' => false,
//                'region' => 2,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកឈូក',
//                'name_en' => 'Chhouk District',
//                'abbr' => 'CHK',
//                'is_head' => false,
//                'region' => 1,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'ការិយាល័យកណ្តាល',
//                'name_en' => 'Head Office',
//                'abbr' => 'HO',
//                'is_head' => true,
//                'region' => 0,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាឃុំអង្គតាសោម',
//                'name_en' => 'Ang Ta Som Commune',
//                'abbr' => 'ATS',
//                'is_head' => false,
//                'region' => 1,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកថ្មគោល',
//                'name_en' => 'Thmakol District',
//                'abbr' => 'TMK',
//                'is_head' => false,
//                'region' => 3,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តសៀមរាប',
//                'name_en' => 'Siem Reap',
//                'abbr' => 'SR',
//                'is_head' => false,
//                'region' => 4,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តកំពង់ធំ',
//                'name_en' => 'Kampong Thom',
//                'abbr' => 'KPT',
//                'is_head' => false,
//                'region' => 4,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តឧត្តរមានជ័យ',
//                'name_en' => 'Oddar Meanchey',
//                'abbr' => 'OMC',
//                'is_head' => false,
//                'region' => 4,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកបវេល',
//                'name_en' => 'Pavel District',
//                'abbr' => 'BAL',
//                'is_head' => false,
//                'region' => 3,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តកំពង់ឆ្នាំង',
//                'name_en' => 'Kampong Chhnang',
//                'abbr' => 'KHH',
//                'is_head' => false,
//                'region' => 2,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាប៉ៃលិន',
//                'name_en' => 'Pailin',
//                'abbr' => 'PAL',
//                'is_head' => false,
//                'region' => 2,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកសង្កែ',
//                'name_en' => 'Sangke District',
//                'abbr' => 'SK',
//                'is_head' => false,
//                'region' => 3,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តស្ទឹងត្រែង',
//                'name_en' => 'Stung Treng',
//                'abbr' => 'ST',
//                'is_head' => false,
//                'region' => 1,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តក្រចេះ',
//                'name_en' => 'Kratie',
//                'abbr' => 'KRT',
//                'is_head' => false,
//                'region' => 1,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តរតនគីរី',
//                'name_en' => 'Ratanakiri',
//                'abbr' => 'RKR',
//                'is_head' => false,
//                'region' => 1,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាខេត្តមណ្ឌលគីរី',
//                'name_en' => 'Mondulkiri',
//                'abbr' => 'MKR',
//                'is_head' => false,
//                'region' => 1,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកអន្លង់វែង',
//                'name_en' => 'Anlong Veng District',
//                'abbr' => 'ALV',
//                'is_head' => false,
//                'region' => 4,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកបន្ទាយអំពិល',
//                'name_en' => 'Banteay Ampil District',
//                'abbr' => 'BTA',
//                'is_head' => false,
//                'region' => 4,
//                'start_date' => now()
//            ],
//            [
//                'name_kh' => 'សាខាស្រុកភ្នំស្រុក',
//                'name_en' => 'Phnom Sok District',
//                'abbr' => 'PSK',
//                'is_head' => false,
//                'region' => 3,
//                'start_date' => now()
//            ],
//        ];

        $insert = [
            [
                'name_kh' => 'ការិយាល័យកណ្តាល',
                'name_en' => 'Head Office',
                'abbr' => 'HO',
                'is_head' => true,
                'region' => 0,
                'start_date' => now(),
            ],

            [
                'name_kh' => 'សាខាខេត្តប៉ៃលិន',
                'name_en' => 'Pailin Provincial Branch',
                'abbr' => 'PLN',
                'is_head' => false,
                'region' => 1,
                'start_date' => now()
            ],
        ];

        foreach ($insert as $branch) {
            Branch::create($branch);
        }
    }
}
