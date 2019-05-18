<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
   
    public function run()
    {
		$usersTable = DB::table('users');
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $usersTable->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		$usersTable->insert(array('name' => 'Administrator', 'email' => 'admin@example.local', 'password' => \Hash::make('123') ));
    }
}
