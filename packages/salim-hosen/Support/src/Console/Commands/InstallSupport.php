<?php

namespace SalimHosen\Support\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallSupport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'support:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install support Package';

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
        $this->info('Installing support...');

        $this->info('Publishing support Files');
        Artisan::call("vendor:publish", ["--tag" => "support"]);
        $this->info('Installed support');
    }


}
