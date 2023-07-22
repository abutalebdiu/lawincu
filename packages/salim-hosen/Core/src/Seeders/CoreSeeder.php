<?php

namespace SalimHosen\Core\Seeders;

use Illuminate\Database\Seeder;

class CoreSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            RoleTableSeeder::class,
            UserRoleTableSeeder::class,
            PermissionTableSeeder::class,
            RolePermissionTableSeeder::class,
            SettingTableSeeder::class,
            CountryTableSeeder::class,
            StateTableSeeder::class,
            LanguageTableSeeder::class,
            CompanyTableSeeder::class,
            CurrencyTableSeeder::class,
            WalletTableSeeder::class
        ]);
    }
}
