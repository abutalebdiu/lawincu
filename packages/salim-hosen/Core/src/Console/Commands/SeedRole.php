<?php

namespace SalimHosen\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use SalimHosen\Core\Models\Role;
use SalimHosen\Core\Seeders\CoreSeeder;

class SeedRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'role:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeding Role';

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
        $role = $this->ask('Role?');

        if(!$role) {
            $this->info("Please Insert an Role");
            return false;
        }

        $exist = Role::where("title", $role)->first();
        if($exist){
            $this->info("Already Exists");
            return false;
        }

        $roles = [
            [
                'title' => $role,
                'role_id' => 0
            ],
        ];

        Role::insert($roles);

        $this->info('Seeded Role');
    }


}
