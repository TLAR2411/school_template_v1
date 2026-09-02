<?php

namespace Database\Seeders\Core;

use App\Models\Core\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inserts = [
            [
                'currency_code' => 'KHR',
                'name_kh' => 'រៀល',
                'name_en' => 'Riel',
                'abbr' => '៛',
                'show' => '៛',
                'default' => true,
                'exchange_rate' => 1
            ],
            [
                'currency_code' => 'USD',
                'name_kh' => 'ដុល្លារ',
                'name_en' => 'Dollar',
                'abbr' => '$',
                'show' => '$',
                'exchange_rate' => 4000,
                'is_active' => false
            ],
            // [
            //     'currency_code' => 'THB',
            //     'name_kh' => 'បាត',
            //     'name_en' => 'Baht',
            //     'abbr' => '฿',
            //     'exchange_rate' => 120,
            //     'is_active' => false
            // ],
            // [
            //     'currency_code' => 'CNY',
            //     'name_kh' => 'យន់',
            //     'name_en' => 'Yuan',
            //     'abbr' => '¥',
            //     'exchange_rate' => 559,
            //     'is_active' => false
            // ],
            // [
            //     'currency_code' => 'VND',
            //     'name_kh' => 'ដុង',
            //     'name_en' => 'Dong',
            //     'abbr' => '₫',
            //     'exchange_rate' => 0.15,
            //     'is_active' => false
            // ]
        ];
        foreach ($inserts as $item) {
            Currency::create($item);
        }
    }
}
