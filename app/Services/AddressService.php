<?php


namespace App\Services;

use App\Models\City;
use App\Models\District;
use App\Models\Ward;

class AddressService
{
    private static function getCities($column = ['*'])
    {
        return City::get($column);
    }


    private static function getDistricts($column = ['*'])
    {
        return District::get($column);
    }


    private static function getWards($column = ['*'])
    {
        return Ward::get($column);
    }

    public static function getAddressInformation()
    {
        $data['cities'] = self::getCities();
        return $data;

    }

}