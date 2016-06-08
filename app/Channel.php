<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
    	'streamer_id',
    	'user_id',
    	'secret'
    ];

    public function user()
    {
    	return $this->belongsTo(\maze\User::class);
    }

    public function streamer()
    {
    	return $this->belongsTo(\maze\Streamer::class);
    }

    public function donations()
    {
        return $this->hasMany(\maze\Donation::class);
    }
}
