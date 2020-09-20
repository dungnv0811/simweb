<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillable = ['name', 'type', 'slug', 'name_with_type', 'path', 'path_with_type', 'code', 'parent_code'];

    public function district() {
        return $this->belongsTo(District::class);
    }
}
