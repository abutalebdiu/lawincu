<?php

namespace SalimHosen\EmailMarketing\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SeedEmailMarketing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emailmarketing:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding Email Marketing Package';

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
