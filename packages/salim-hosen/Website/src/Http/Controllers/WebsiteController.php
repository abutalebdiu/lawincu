<?php

namespace SalimHosen\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use SalimHosen\Website\Models\Page;

class WebsiteController extends Controller
{


    public function customWebpage($slug = null){

        $page = Page::where('url', $slug)
            ->where("language_code", app()->getLocale())->first();
        if(!$page) abort(404, "Not Found");

        // $theme = config("settings.theme");
        $theme = env("THEME", "basic");
        return view('website::webpage', compact('page', 'theme'));
    }


}
