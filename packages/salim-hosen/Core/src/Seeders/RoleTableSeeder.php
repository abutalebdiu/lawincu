<?php

namespace SalimHosen\Core\Seeders;

use Illuminate\Database\Seeder;
use SalimHosen\Core\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'admin',
                'role_id' => 0
            ],
        ];

        Role::insert($roles);
    }
}
