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
    public function getDistricts($code)
    {
        $districts = DB::table("districts")
            ->where("parent_code",$code)
            ->pluck("name_with_type","code");
        return response()->json($districts);
    }

    //For fetching wards
    public function getWards($code)
    {
        $wards= DB::table("wards")
            ->where("parent_code",$code)
            ->pluck("name_with_type","code");
        return response()->json($wards);
    }
}
