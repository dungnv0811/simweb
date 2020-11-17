<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'm_branches';
    protected $fillable = ['name', 'slug', 'type', 'name_with_type', 'code'];
}
