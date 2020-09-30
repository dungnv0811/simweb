<?php

namespace App\Models;

use App\Libraries\Traits\Image;
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
        'ward_code',
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

    const IS_RECOMMEND = 1;

    public function comments() {
        return $this->morphMany(PostComment::class, 'commentable')->whereNull('parent_id');
    }


    public function scopeAddress($query)
    {
        return $query->join('wards', 'wards.code', '=', 'posts.ward_code')
            ->join('districts', 'districts.code', '=', 'wards.parent_code')
            ->join('cities', 'cities.code', '=', 'districts.parent_code');
    }


    public function scopeWard($query)
    {
        return $query->join('wards', 'wards.code', '=', 'posts.ward_code');
    }

    public function getImageAttribute()
    {
        $result = [];
        foreach (json_decode($this->images) as $key => $image) {
            $result[$key] = asset('/uploads/images' . DIRECTORY_SEPARATOR .  config('define.image.product') . DIRECTORY_SEPARATOR . $image);
        }
        return $result;
    }
}
