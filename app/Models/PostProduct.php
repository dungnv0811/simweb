<?php

namespace App\Models;

use App\Casts\MoneyFormatCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


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
        'state',
        'status',
        'is_recommended'
    ];

    protected $casts = [
        'price' => MoneyFormatCast::class
    ];

    const NEW = 0;
    const SECONDHAND = 1;

    const IS_RECOMMEND = 1;

    const AWAITING_APPROVAL = 0;
    const APPROVED = 1;

    public function comments()
    {
        return $this->morphMany(PostComment::class, 'commentable')->whereNull('parent_id');
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeStatusApprovedCondition(Builder $builder)
    {
        return $builder->where(['status' => self::APPROVED]);
    }

    /**
     * @param $query
     * @return mixed
     */
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

    /**
     * @param $query
     * @return mixed
     */
    public function scopeUser($query)
    {
        return $query->join('users', 'users.id', '=', 'posts.user_id');
    }

    /**
     * @return array
     */
    public function getImageAttribute()
    {
        $result = [];
        foreach (json_decode($this->images) as $key => $image) {
            $result[$key] = asset('/uploads/images' . DIRECTORY_SEPARATOR . config('define.image.product') . DIRECTORY_SEPARATOR . $image);
        }
        return $result;
    }

    /**
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function getStateLabelAttribute()
    {
        return trans("post.status.$this->state");
    }

}
