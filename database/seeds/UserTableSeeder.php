<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_basic = Role::where('name', 'basic')->first();

        $admin = new User();
        $admin->email = 'admin@admin.com';
        $admin->username = 'admin';
        $admin->password = Hash::make('password');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $basic = new User();
        $basic->email = 'test01@gmail.com';
        $basic->username = 'test01';
        $basic->password = Hash::make('testtest');
        $basic->save();
        $basic->roles()->attach($role_basic);
    }
}
