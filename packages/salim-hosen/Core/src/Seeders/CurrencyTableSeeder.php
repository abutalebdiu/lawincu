<?php

namespace SalimHosen\Core\Seeders;

use SalimHosen\Core\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'id' => 1,
            'name' => 'US Dollar',
            'code' => "USD",
            'symbol' => '$',
            'exchange_rate' => 1,
            // 'additional_charge' => 0.0,
            'position' => 'left',
            'is_active' => true,
        ]);

        Currency::create([
            'id' => 2,
            'name' => 'Bangladeshi Taka',
            'code' => "BDT",
            'symbol' => '৳',
            'exchange_rate' => 85.67,
            // 'additional_charge' => 0.0,
            'position' => 'left',
            'is_active' => true,
        ]);

    }
}
