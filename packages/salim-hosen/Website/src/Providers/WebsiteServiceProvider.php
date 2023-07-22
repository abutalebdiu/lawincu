<?php

namespace SalimHosen\Website\Providers;

use Illuminate\Support\ServiceProvider;
use SalimHosen\Website\Console\Commands\InstallWebsite;
use SalimHosen\Website\Console\Commands\SeedWebsite;
use SalimHosen\Website\View\Components\MetaTags;

class WebsiteServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__."/../../routes.php");
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'website');
        $this->loadViewComponentsAs("website", [
            "meta-tags" => MetaTags::class
        ]);

        if(app()->runningInConsole()){

            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

            $this->publishResources();

            $this->loadCommands();
        }
    }

    public function register()
    {
        //
    }

    public function publishResources(){
        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('/'),
            __DIR__ . '/../Export/routes' => base_path('routes'),
        ], 'website');
    }

    public function loadCommands(){
        $this->commands([
            InstallWebsite::class,
            SeedWebsite::class
        ]);
    }
}
