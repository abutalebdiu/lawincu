<?php


// Country

use SalimHosen\EmailMarketing\Http\Controllers\CampaignController;
use SalimHosen\EmailMarketing\Http\Controllers\FolderController;
use SalimHosen\EmailMarketing\Http\Controllers\MailingListController;
use SalimHosen\EmailMarketing\Http\Controllers\SenderController;
use SalimHosen\EmailMarketing\Http\Controllers\SubscriberController;
use SalimHosen\EmailMarketing\Http\Controllers\TemplateController;

Route::group(["middleware" => ["web"]], function () {

    // Route::resource('folders', FolderController::class);
    Route::resource('senders', SenderController::class);
    Route::resource('subscribers', SubscriberController::class);
    Route::resource("campaigns", CampaignController::class);
    Route::resource("mailing-lists", MailingListController::class);
    Route::resource("email-templates", TemplateController::class);
    // Route::resource("automations", CampaignController::class);

});


