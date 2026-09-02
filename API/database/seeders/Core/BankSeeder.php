<?php

namespace Database\Seeders\Core;

use App\Models\Core\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    public function run(): void
    {
        Bank::create([
            'name_kh' => 'Default Bank',
            'name_en' => 'Default Bank',
            'swift_bic' => 'DFLTKHPP',
            'image_path' => null,
            'is_active' => true,
        ]);
    }
}
