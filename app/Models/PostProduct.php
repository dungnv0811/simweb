<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostProduct extends Model
{

    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'ward_id',
        'branch',
        'model',
        'price',
        'images',
        'short_description',
        'description',
        'status',
        'is_recommended'
    ];

    const NEW = 0;
    const SECONDHAND = 1;

    public function comments() {
        return $this->morphMany(PostComment::class, 'commentable')->whereNull('parent_id');
    }
}
