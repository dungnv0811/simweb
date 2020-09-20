<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(CitySeeder::class);
         $this->call(DistrictSeeder::class);
         $this->call(WardSeeder::class);
         $this->call(WardZSeeder::class);
         $this->call(PostSeeder::class);
    }
}
