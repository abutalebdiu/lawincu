<?php

namespace SalimHosen\Support\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use SalimHosen\Core\Seeders\CoreSeeder;

class SeedSupport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'support:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding support Package';

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
        $this->info('Seeding support...');
        Artisan::call("db:seed", ['--class' => CoreSeeder::class]);
        $this->info('Seeded');
    }


}
