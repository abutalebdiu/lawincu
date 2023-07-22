<?php

namespace SalimHosen\Crm\Providers;

use Illuminate\Support\ServiceProvider;

class CrmServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadRoutesFrom(__DIR__."/../../routes.php");
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'crm');
        $this->loadMigrationsFrom(__DIR__."/../../database/migrations");

    }

    public function register()
    {
        //
    }
}
