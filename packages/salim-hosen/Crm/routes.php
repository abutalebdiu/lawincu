<?php

use Illuminate\Support\Facades\Route;
use SalimHosen\Crm\Http\Controllers\ContactController;
use SalimHosen\Crm\Http\Controllers\LeadController;
use SalimHosen\Crm\Http\Controllers\LeadSourceController;
use SalimHosen\Crm\Http\Controllers\LeadStageController;
use SalimHosen\Crm\Http\Controllers\PipelineController;

Route::group(["middleware" => ["web"]], function () {

    Route::resource('pipelines', PipelineController::class);
    Route::resource('lead-stages', LeadStageController::class);
    Route::resource('lead-sources', LeadSourceController::class);
    Route::resource('leads', LeadController::class);
    Route::put('lead/stage/{lead}', [LeadController::class, "changeStage"]);

});





