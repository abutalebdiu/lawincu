<?php

namespace SalimHosen\MailBox\Providers;

use Illuminate\Support\ServiceProvider;

class MailBoxServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadRoutesFrom(__DIR__."/../../routes.php");
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'mailbox');

    }

    public function register()
    {
        //
    }
}
