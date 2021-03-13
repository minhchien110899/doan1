<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        User::truncate();
        Admin::create([
        	'name' => 'admin',
        	'username' => 'admin',
        	'email' => 'admin@multiChoice.io',
        	'password' => Hash::make('adminadmin'),
        ]);
        User::create([
        	'name' => 'user',
        	'username' => 'user',
        	'email' => 'user@multiChoice.io',
        	'password' => Hash::make('useruser'),
        ]);
    }
}
