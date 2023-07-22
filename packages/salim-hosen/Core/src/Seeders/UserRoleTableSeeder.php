<?php

namespace SalimHosen\Core\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);
    }
}
