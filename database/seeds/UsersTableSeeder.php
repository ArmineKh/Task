<?php

use Illuminate\Database\Seeder;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
    		'name' => 'Admin',
    		'email' => 'admin@gmail.com',
    		'password' => bcrypt('12345678'),
    		'isadmin' => '1',
    		'verify' => '1',
    	]);
    } 
}
