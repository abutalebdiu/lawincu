<?php

namespace SalimHosen\Core\Seeders;

use SalimHosen\Core\Models\State;
use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                "id" => 1,
                "name" => "Riyadh",
                "arabic_name" => "Riyadh",
                "country_id" => 1
            ],
            [
                "id" => 2,
                "name" => "Makkah",
                "arabic_name" => "Makkah",
                "country_id" => 1
            ],
            [
                "id" => 3,
                "name" => "Gazipur",
                "arabic_name" => "gazipur",
                "country_id" => 2
            ],
            [
                "id" => 4,
                "name" => "Dhaka",
                "arabic_name" => "dhaka",
                "country_id" => 2
            ],
            [
                "id" => 5,
                "name" => "California",
                "arabic_name" => "california",
                "country_id" => 3
            ],
            [
                "id" => 6,
                "name" => "Texas",
                "arabic_name" => "texas",
                "country_id" => 3
            ],
        ];

        State::insert($states);
    }
}
