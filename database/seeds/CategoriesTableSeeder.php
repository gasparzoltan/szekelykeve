<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Helyi iroda',            
            'slug' => 'helyi-iroda',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),            
        ]);
        DB::table('categories')->insert([
            'name' => 'Kultúra',            
            'slug' => 'kultura',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),            
        ]);  
        DB::table('categories')->insert([
            'name' => 'Vöröskereszt',            
            'slug' => 'voroskereszt',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),            
        ]);
		DB::table('categories')->insert([
            'name' => 'Sport',            
            'slug' => 'sport',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),            
        ]);		
       	DB::table('categories')->insert([
            'name' => 'Egyéb',            
            'slug' => 'egyeb',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),            
        ]);       	            
    }
}
