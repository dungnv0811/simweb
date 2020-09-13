<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'image',
        'short_description',
        'description',
        'status',
        'is_recommended'
    ];


    public function comments() {
        return $this->morphMany(PostComment::class, 'commentable')->whereNull('parent_id');
    }
}
