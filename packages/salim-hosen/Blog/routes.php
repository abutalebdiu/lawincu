<?php

use SalimHosen\Blog\Http\Controllers\CategoryController;
use SalimHosen\Blog\Http\Controllers\PostController;
use SalimHosen\Blog\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use SalimHosen\Blog\Http\Controllers\BlogController;

Route::group(["middleware" => ["web"]], function () {

    // All Blog Routes goes here
    Route::resource('blog-categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('tags', TagController::class);

});

