<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = ['district_id', 'slug', 'body'];

    public function district() {
        return $this->belongsTo(District::class);
    }
}
