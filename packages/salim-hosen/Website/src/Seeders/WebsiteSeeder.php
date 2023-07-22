<?php

namespace SalimHosen\Website\Seeders;

use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PageTableSeeder::class,
            MenuTableSeeder::class,
        ]);
    }
}
