<?php

use Carbon\Carbon;
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
        $status = [
            'unpublished',
            'published'
        ];
        for ($i=0; $i < 2000; $i++) {
            DB::table('posts')->insert([
                'user_id' => rand(1, 2),
                'slug' => 'i-want-to-sell-'.$i,
                'title' => 'I want to sell sim '.$i,
                'image' => 'admin',
                'short_description' => 'test short description',
                'description' => 'test long description',
                'state' => rand(0, 1),
                'status' => $status[rand(0, 1)],
                'is_recommended' => rand(0, 1),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
