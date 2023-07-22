<?php

namespace SalimHosen\Support\Providers;

use Illuminate\Support\ServiceProvider;
use SalimHosen\Support\Console\Commands\InstallSupport;

class SupportServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/../../routes.php");
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'support');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        if(app()->runningInConsole()){
            $this->commands([
                InstallSupport::class
            ]);
        }
    }

    public function register()
    {
        //
    }
}
