<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'type', 'slug', 'name_with_type', 'path', 'path_with_type', 'code', 'parent_code'];

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }
}
