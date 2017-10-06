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
            'firstname' => 'Zoltán', 
            'lastname' => 'Gáspár',
            'email' => 'gasparzoltan@gmx.com',
            'gender' => 0,
            'country_id' => 186,
            'password' => bcrypt('password'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),            
        ]);
    }
}
