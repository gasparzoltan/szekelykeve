<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'super admin',            
            'slug' => 'super-admin',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),            
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',           
            'slug' => 'admin',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),                 
        ]);
        DB::table('roles')->insert([
            'name' => 'moderator',            
            'slug' => 'moderator',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),            
        ]);        
    }
}
