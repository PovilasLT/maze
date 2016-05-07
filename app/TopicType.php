<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Config;

class TopicType extends Model
{

    protected $visible = [
        'id',
        'name',
        'color',
        'is_selflock',
        'is_admin',
        'is_ad'
    ];

    public function scopeAds($query)
    {
        return $query->where('is_ad', '=', '1');
    }
}
