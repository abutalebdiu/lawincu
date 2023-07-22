<?php

namespace SalimHosen\Core\Seeders;

use SalimHosen\Core\Models\Language;
use Illuminate\Database\Seeder;
use SalimHosen\Core\Models\Country;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $usa = Country::where("iso_code_2", "us")->first();
        $sar = Country::where("iso_code_2", "sa")->first();

        $languages = [
            [
                "id"          => 1,
                "name"        => "English",
                "country_id"  => $usa->id,
                "code"      => "en",
                "direction"   => "ltr",
                "is_active"      => true,
            ],
            [
                "id"          => 2,
                "name"        => "Arabic",
                "country_id"  => $sar->id,
                "code"      => "ar",
                "direction"   => "rtl",
                "is_active"      => true,
            ],
        ];

        Language::insert($languages);
    }
}
