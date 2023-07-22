<?php

namespace SalimHosen\Website\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'website:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Website Package';

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
        $this->info('Installing Website...');

        $this->info('Publishing Website Files');
        Artisan::call("vendor:publish", ["--tag" => "website", "--force" => true]);
        Artisan::call("migrate");
        // Artisan::call("website:seed");
        $this->info('Installed Website');
    }


}
