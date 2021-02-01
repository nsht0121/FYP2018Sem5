<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Administrator';
        $role_admin->save();

        $role_basic = new Role();
        $role_basic->name = 'basic';
        $role_basic->description = 'Simple User';
        $role_basic->save();
    }
}
