<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\CompanySetupController;
use App\Http\Controllers\Admin\PropertyController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



 // Web Routes
    Route::get('/', [WebController::class, 'index'])->name('welcome');
    Route::get('aboutus',[WebController::class,'aboutus'])->name('aboutus');

    // End Web Routes



    Route::get('get/state',[WebController::class,'getstate'])->name('get.state');

    Route::group(['middleware' => ['auth'],'prefix'=>'admin','as'=>'admin.'], function () {
        Route::resource('property',PropertyController::class);
    });





















Route::get('register', [RegisterController::class, 'showRegister'])->name("register")->middleware("guest");

Route::get('login', function(){
    return view("auth.login");
})->name("login")->middleware("guest");

Route::get('supplier-login', function(){
    return view("auth.supplier-login");
})->name("supplier.login")->middleware("guest");


// Guest Routes
Route::view('password/request', "auth.passwords.email")->name("password.request");
Route::view('password/reset/{token}', "auth.passwords.reset")->name("password.reset");
Route::view('verification/resend', "auth.verification.resend")->name("verification.resend");
Route::view('verification/verify/{user}', "auth.verification.verify")->name("verify.email");


// dashboard routes
Route::get('/home/buyer', [HomeController::class, 'index'])->name("home.buyer");
Route::get('/home/supplier', [HomeController::class, 'supplier'])->name("home.supplier");

// Suppliers Routes
Route::resource('company-setup', CompanySetupController::class)->only(["create", "store"]);
