<?php

namespace SalimHosen\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallMultiLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multilanguage:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Multi Language Package';

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

        Artisan::call("vendor:publish", ["--tag" => "multilanguage"]);
        exec('composer require stichoza/google-translate-php');
        $this->info('Installed Core');
    }


}
