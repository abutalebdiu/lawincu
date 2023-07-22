<?php

namespace SalimHosen\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Factory;
use SalimHosen\Core\Console\Commands\InstallCore;
use SalimHosen\Core\Console\Commands\InstallMultiLanguage;
use SalimHosen\Core\Console\Commands\ParseLanguage;
use SalimHosen\Core\Console\Commands\SeedCore;
use SalimHosen\Core\Console\Commands\SeedRole;
use SalimHosen\Core\Console\Commands\TranslateLanguage;
use SalimHosen\Core\Models\Setting;
use SalimHosen\Core\Models\Translation;
use SalimHosen\Core\View\Components\CompanySelector;
use SalimHosen\Core\View\Components\ConfirmDialog;
use SalimHosen\Core\View\Components\DeleteDialog;
use SalimHosen\Core\View\Components\Notification;
use SalimHosen\Core\View\Components\QueryLangSelector;

class CoreServiceProvider extends ServiceProvider
{

    public function boot(Factory $cache)
    {

        if (app()->runningInConsole()) {

            $this->registerResources();

            $this->loadMigrationsFrom(__DIR__ . "/../../database/migrations");

            $this->registerCommands();

        } else {

            $this->loadRoutesFrom(__DIR__ . "/../../routes.php");

            $this->loadViewsFrom(__DIR__ . "/../../resources/views", "core");

            $this->loadComponents();

            $this->registerHelpers();

            $this->loadSettings($cache);
        }
    }

    public function register()
    {
        //
    }

    public function loadSettings($cache)
    {
        $settings = $cache->remember('settings', 60, function () {
            // Laravel >= 5.2, use 'lists' instead of 'pluck' for Laravel <= 5.1
            $data = [];
            foreach (Setting::all() as $row) {
                $data[$row->key] = $row->value;
            };

            return $data;
        });

        config()->set('settings', $settings);
    }


    public function loadComponents(){
        $this->loadViewComponentsAs("core", [
            // "param-lang-selector" => ParamSelector::class,
            "query-lang-selector" => QueryLangSelector::class,
            "notification" => Notification::class,
            "company-selector" => CompanySelector::class,
            "delete-dialog" => DeleteDialog::class,
            "confirm-dialog" => ConfirmDialog::class,
            // "currency" => Currency::class
        ]);
    }

    public function registerHelpers()
    {
        // Load the helpers in /../Helpers/helpers.php
        if (file_exists($file =  __DIR__ . '/../Helpers/Helper.php')) {
            require $file;
        }
    }

    public function registerResources()
    {

        $this->publishes([
            __DIR__ . '/../Models/User.php' => app_path("Models/User.php"),
            __DIR__ . '/../../resources/assets' => public_path('/'),
            __DIR__ . '/../Events' => app_path('Events'),
            __DIR__ . '/../Export/routes' => base_path('routes'),
            __DIR__ . '/../Export/config' => base_path('config'),
        ], 'core');
    }



    public function registerCommands()
    {
        $this->commands([
            InstallCore::class,
            SeedCore::class,
            SeedRole::class,
            InstallMultiLanguage::class,
            ParseLanguage::class,
            TranslateLanguage::class
        ]);
    }
}
