<?php

namespace Database\Seeders;

use Database\Seeders\Address\AddressSeeder;
use Database\Seeders\Auth\OAtuhSeeder;
use Database\Seeders\Auth\PositionSeeder;
use Database\Seeders\Auth\RoleSeeder;
use Database\Seeders\Auth\SettingSeeder;
use Database\Seeders\Auth\UserSeeder;
use Database\Seeders\Core\BankSeeder;
use Database\Seeders\Core\BranchSeeder;
use Database\Seeders\Core\CompanySeeder;
use Database\Seeders\Core\CurrencySeeder;
use Database\Seeders\Core\DepartmentSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            OAtuhSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            BankSeeder::class,
            BranchSeeder::class,
            CurrencySeeder::class,
            SettingSeeder::class,
            AddressSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
        ]);
    }
}
