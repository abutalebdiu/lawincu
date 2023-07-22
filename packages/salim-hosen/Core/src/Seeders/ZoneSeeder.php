<?php

namespace SalimHosen\Core\Seeders;

use Illuminate\Database\Seeder;
use SalimHosen\Core\Models\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Zone::create([
            "company_id" => 1,
            "name" => "All Other Zone"
        ]);

    }
}
