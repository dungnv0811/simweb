<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    //For fetching all cities
    public function getCities()
    {
        $cities= DB::table("cities")->get();
        return $cities;
        return view('posts.create', compact('cities'));
    }

    //For fetching districts
    public function getDistricts($id)
    {
        $districts = DB::table("districts")
            ->where("city_id",$id)
            ->pluck("body","id");
        return response()->json($districts);
    }

    //For fetching wards
    public function getWards($id)
    {
        $wards= DB::table("wards")
            ->where("district_id",$id)
            ->pluck("body","id");
        return response()->json($wards);
    }
}
