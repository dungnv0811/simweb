<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['city_id', 'slug', 'body'];

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }
}
