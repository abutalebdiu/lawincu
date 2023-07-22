<?php

namespace SalimHosen\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Core Package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Installing Core...');

        $this->info('Publishing Core Files');
        Artisan::call("vendor:publish", ["--tag" => "core", "--force" => true]);
        Artisan::call("migrate:fresh");

        exec('composer require laravel/ui');
        exec('composer require intervention/image');
        exec('composer require yajra/laravel-datatables-oracle');
        exec('composer require pusher/pusher-php-server');
        exec('composer require maatwebsite/excel');
        // exec('composer require psr/simple-cache:^1.0 maatwebsite/excel');
        exec('npm install');
        exec('npm install --save-dev laravel-echo pusher-js');
        exec('npm run dev');
        // Artisan::call("core:seed");

        $this->info('Installed Core');
    }


}
