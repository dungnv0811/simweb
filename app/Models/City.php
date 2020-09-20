<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['slug', 'body'];

    /**
     * Get the comments for the blog post.
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
