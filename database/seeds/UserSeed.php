<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->id = 1000001;
        $user->email = 'admin';
        $user->name = 'Administrator';
        $user->is_admin = 0;
        $user->password = \Illuminate\Support\Facades\Hash::make('admin');
        $user->save();
        $user = new \App\User();
        $user->id = 1000000;
        $user->email = 'super_admin';
        $user->name = 'Super Administrator';
        $user->is_admin = 1;
        $user->password = \Illuminate\Support\Facades\Hash::make('super_admin');
        $user->save();
    }
}
