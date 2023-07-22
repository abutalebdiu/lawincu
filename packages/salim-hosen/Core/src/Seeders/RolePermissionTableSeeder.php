<?php

namespace SalimHosen\Core\Seeders;

use SalimHosen\Core\Models\Permission;
use Illuminate\Database\Seeder;
use SalimHosen\Core\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all()->pluck("id");
        Role::findOrFail(1)->permissions()->sync($permissions);

    } 
}
