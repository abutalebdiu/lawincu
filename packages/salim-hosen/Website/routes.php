<?php


// Country

use SalimHosen\Website\Http\Controllers\MenuController;
use SalimHosen\Website\Http\Controllers\PageController;
use SalimHosen\Website\Http\Controllers\PageRowController;
use SalimHosen\Website\Http\Controllers\WebsiteController;
use SalimHosen\Website\Http\Controllers\PageColumnController;

Route::group([
    'middleware' => [
        'web'
    ],
], function () {

    // Pages
    Route::resource('pages', PageController::class);

    // Site Menu
    Route::resource('menus', MenuController::class);

    Route::resource('page-rows', PageRowController::class);

    Route::resource('page-columns', PageColumnController::class);

    // Dont Remove This Route
    Route::get("page/{slug?}", [WebsiteController::class, 'customWebpage'])->name("page.custom");

});
