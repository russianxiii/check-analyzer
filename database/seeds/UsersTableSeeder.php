<?php

use Illuminate\Database\Seeder;

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
            'name' => 'user1',
            'email' => 'user1'.'@ca.app',
            'password' => bcrypt('123456'),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);
    }
}
