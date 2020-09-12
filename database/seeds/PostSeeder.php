<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 2000; $i++) {
            DB::table('posts')->insert([
                'user_id' => 1,
                'slug' => 'i-want-to-sell-'.$i,
                'title' => 'I want to sell sim '.$i,
                'image' => 'admin',
                'short_description' => 'test short description',
                'description' => 'test long description',
                'status' => 'published',
            ]);
        }
    }
}
