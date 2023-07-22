<?php

namespace SalimHosen\Blog\Providers;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadRoutesFrom(__DIR__."/../../routes.php");
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'blog');
        $this->loadMigrationsFrom(__DIR__."/../../database/migrations");

        // $this->publishes([
        //     __DIR__.'/../../database/seeders' => database_path('seeders'),
        // ], 'blog');

    }

    public function register()
    {
        //
    }
}
