<?php

namespace SalimHosen\Website\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use SalimHosen\Website\Seeders\WebsiteSeeder;

class SeedWebsite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'website:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding Core Package';

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
        $this->info('Seeding Website...');

        Artisan::call("db:seed", ['--class' => WebsiteSeeder::class]);

        $this->info('Seeded');
    }


}
