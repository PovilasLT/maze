<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
    	'body',
    	'username',
    	'amount'
    ];

    public function channel()
    {
    	return $this->belongsTo(maze\Channel::class);
    }
}