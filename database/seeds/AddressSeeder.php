<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Cần Thơ',
            'Đà Nẵng',
            'Hải Phòng',
            'Hà Nội',
            'TP HCM',
        ];
        foreach($cities as $key => $city) {
            DB::table('cities')->insert([
                'slug' => str_slug($city, '-'),
                'body' => $city
            ]);
        }

        foreach($cities as $key => $city) {
            DB::table('districts')->insert([
                'city_id' => $key + 1,
                'slug' => str_slug($city . 'districts', '-'),
                'body' => $city.'districts'
            ]);

            DB::table('districts')->insert([
                'city_id' => $key + 1,
                'slug' => str_slug($city . 'districts', '-'),
                'body' => $city.'districts'
            ]);
        }

        foreach($cities as $key => $city) {
            DB::table('wards')->insert([
                'district_id' => $key + 1,
                'slug' => str_slug($city . 'wards', '-'),
                'body' => $city.'wards'
            ]);

            DB::table('wards')->insert([
                'district_id' => $key + 1,
                'slug' => str_slug($city . 'wards', '-'),
                'body' => $city.'wards'
            ]);
        }
    }
}
