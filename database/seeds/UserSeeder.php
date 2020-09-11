<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'dung nguyen',
            'email' => 'dungnguyen@example.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_type' => 'admin',
            'password' => 'devekis01',
        ]);
    }
}
