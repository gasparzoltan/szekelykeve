<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $faker = Faker\Factory::create();

	    for($i = 0; $i < 100; $i++) {
	    	$title = $faker->sentence;
	    	$slug = str_slug($title, '-');
	        DB::table('articles')->insert([
	            'title' => $title,            
	            'slug' => $slug,
	            'image' => '',
	            'content' => $faker->paragraphs(rand(5, 10), true),
	            'key' => str_random(40),
	            'user_id' => 1,
	            'category_id' => rand(1, 5),
	            'published_at' => date("Y-m-d H:i:s"),
	            'created_at' => date("Y-m-d H:i:s"),
	            'updated_at' => date("Y-m-d H:i:s"),            
	        ]);
	    }        
    }
}
