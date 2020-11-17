<?php

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Apple'],
            ['name' => 'Asus'],
            ['name' => 'Blackberry'],
            ['name' => 'Google'],
            ['name' => 'Huawei'],
            ['name' => 'LG'],
            ['name' => 'Lenovo'],
            ['name' => 'Nokia'],
            ['name' => 'Oppo'],
            ['name' => 'Sony'],
            ['name' => 'Samsung'],
            ['name' => 'VinSmart'],
            ['name' => 'Vivo'],
            ['name' => 'Xiaomi'],
            ['name' => 'Hãng khác'],
        ];
        DB::table('m_branches')->insert($data);
    }
}
