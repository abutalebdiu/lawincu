<?php

namespace SalimHosen\EmailMarketing\Providers;

use Illuminate\Support\ServiceProvider;
use SalimHosen\EmailMarketing\Console\Commands\InstallEmailMarketing;

class EmailMarketingServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/../../routes.php");
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'emailmarketing');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        if(app()->runningInConsole()){
            $this->publishes([
                __DIR__.'/../../resources/assets' => public_path('/'),
            ], 'emailmarketing');

            $this->commands([
                InstallEmailMarketing::class
            ]);
        }

    }

    public function register()
    {
        //
    }
}
