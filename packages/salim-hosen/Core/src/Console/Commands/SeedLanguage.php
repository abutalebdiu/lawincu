<?php

namespace SalimHosen\MultiLanguage\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use SalimHosen\MultiLanguage\Seeders\LanguageTableSeeder;

class SeedLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed Languages';

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
        $this->info('Seeding Languages...');
        Artisan::call("db:seed", ['--class' => LanguageTableSeeder::class]);
        $this->info('Seeded');
    }


}
