<?php

namespace SalimHosen\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use SalimHosen\Core\Seeders\CoreSeeder;

class SeedCore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:seed';

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
        $this->info('Seeding Core...');

        Artisan::call("db:seed", ['--class' => CoreSeeder::class]);

        $this->info('Seeded');
    }


}
