<?php

namespace Database\Seeders\Core;

use App\Models\Core\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name_kh' => 'សង្ឃឹម ហ្វាយណែន ',
            'name_en' => 'Sangkhum Finance',
        ]);
    }
}
