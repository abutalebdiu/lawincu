<?php

namespace SalimHosen\Website\Seeders;

use SalimHosen\Website\Models\Page;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $newpage = [
            "id" => 1,
            "name" => "Home",
            "language_code" => "en",
            "title" => "Asoug B2B Ecommerce",
            "keywords" => "asoug,b2b,ecommerce",
            "description" => "Asoug is a B2B Ecommerce Platform",
            "content" => '<!DOCTYPE html>
            <html>
            <head>
            </head>
            <body>
            <h2 style="text-align: center;">&nbsp;</h2>
            <p>&nbsp;</p>
            <h2 style="text-align: center;">Welcome to our <strong>Homapage</strong></h2>
            <p style="text-align: center;">Thank you for visiting our site</p>
            <p style="text-align: center;">&nbsp;</p>
            <p style="text-align: center;">&nbsp;</p>
            </body>
            </html>',
            "customization_route" => "welcome.customize"
        ];

        Page::insert($newpage);
    }
}
