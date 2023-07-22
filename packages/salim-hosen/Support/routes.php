<?php

use SalimHosen\Support\Http\Controllers\Support\ContactUsController;
use SalimHosen\Support\Http\Controllers\Support\CustomerQueryController;
use SalimHosen\Support\Http\Controllers\Support\SupportTicketController;

Route::group([
    'middleware' => [
        'web'
    ],
], function () {

    // Support
    Route::resource('support-tickets', SupportTicketController::class);
    Route::resource('contact-messages', ContactUsController::class);
    Route::resource('customer-queries', CustomerQueryController::class);
});
