<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ServerComment extends Model
{
	protected $table = 'server_comments';

	protected $fillable = [
		'body',
		'body_original',
		'user_id',
		'server_id',
	];

    public function server() {
    	return $this->belongsTo('maze\Server');
    }

    public function user() {
    	return $this->belongsTo('maze\User');
    }

    // Kopijuota iš reply.php
    public function voted($type, $user = null) {
		if($user || $user = Auth::user())
		{
			$vote = Vote::where('votable_id', $this->id)->where('votable_type', 'ServerComment')->where('user_id', $user->id)->where('is', $type.'vote')->first();
			if($vote)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		else 
		{
			return false;
		}
	}
}
