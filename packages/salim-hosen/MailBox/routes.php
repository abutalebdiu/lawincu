<?php

use Illuminate\Support\Facades\Route;
use SalimHosen\MailBox\Http\Controllers\MailMessageController;

Route::group(["middleware" => ["web"]], function () {

    Route::resource('mail-message', MailMessageController::class);

});





