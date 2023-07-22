<?php

namespace SalimHosen\Website\Seeders;

use SalimHosen\Website\Models\SiteMenu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menus = [
            [
                "id" => 1,
                "name" => "Home",
                "arabic_name" => "كيف",
                "site_menu_id" => null,
                "icon" => null,
                "show_on_footer" => false,
                "show_on_header" => false,
                "url" => "",
            ],
        ];

        SiteMenu::insert($menus);
    }
}
