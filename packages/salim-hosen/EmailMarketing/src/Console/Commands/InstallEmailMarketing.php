<?php

namespace SalimHosen\EmailMarketing\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallEmailMarketing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailmarketing:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Email Markeing Package';

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
        $this->info('Installing Email Markeing...');

        $this->info('Publishing Email Markeing Files');
        Artisan::call("vendor:publish", ["--tag" => "emailmarketing"]);
        exec('composer require sendinblue/api-v3-sdk');
        exec('composer require maatwebsite/excel "3.1.38"');
        $this->info('Installed Email Markeing');
    }


}
