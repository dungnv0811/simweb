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
        $branches = [
            'OPPO',
            'apple'
        ];
        for ($i=0; $i < 2000; $i++) {
            DB::table('posts')->insert([
                'user_id' => rand(1, 2),
                'slug' => 'i-want-to-sell-'.$i,
                'title' => 'I want to sell sim '.$i,
                'images' => 'admin',
                'short_description' => 'test short description',
                'description' => 'test long description',
                'ward_code' => '20197',
                'branch' => $branches[rand(0, 1)],
                'model' => 'OPPO A5',
                'state' => rand(0, 1),
                'status' => rand(0, 1),
                'price' => 1200,
                'is_recommended' => rand(0, 1),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
