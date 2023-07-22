<?php

namespace SalimHosen\Core\Seeders;

use Illuminate\Database\Seeder;
use SalimHosen\Core\Models\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [ "key" => "logo", "value" => null, ],
            [ "key" => "phone", "value"  => "+966 551175959" ],
            [ "key" => "email", "value"  => "info@asoug.com" ],
            [ "key" => "address", "value"  => "Riadah Incubators Startup Studio And corporate factory - Khaldiya Towers - 4th Tower - Faisal Bin Turki Road - Office No. 6 - Floor 13 - Riyadh" ],
            [ "key" => "title", "value"  => "Asoug.com" ],
            [ "key" => "description", "value"  => "Asoug is a B2B Marketplace" ],
            [ "key" => "facebook", "value"  => "http://www.facebook.com" ],
            [ "key" => "twitter", "value"  => "http://www.twitter.com" ],
            [ "key" => "linkedin", "value"  => "http://linkedin.com" ],
            [ "key" => "pinterest", "value"  => "http://pinterest.com" ],
            [ "key" => "android_app_url", "value"  => "http://google.com" ],
            [ "key" => "ios_app_url", "value"  => "http://apple.com" ],
            [ "key" => "language", "value"  => "en" ],
            [ "key" => "currency", "value"  => "USD" ],
            [ "key" => "theme", "value"  => "basic" ],
        ];

        Setting::insert($settings);
    }
}
