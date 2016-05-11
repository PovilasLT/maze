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
    	return $this->belongsTo('maze\GameServer');
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

	public function getUrlAttribute() {
		return $this->server->url.'#komentaras-'.$this->id;
	}

	public function getNotificationAttribute() {
		return 'Parašė <a href="'.$this->url.'">atsakymą</a> į serverio temą <a href="' . $this->server->url . '" alt="' . e($this->server->name) . '" title="' . e($this->server->name) . '">' . e($this->server->name) . '</a>';
	}

	public function getActivityAttribute() {
		return 'Parašė <a href="'.$this->url.'">atsakymą</a> į serverio temą <a href="' . $this->server->url . '" alt="' . e($this->server->name) . '" title="' . e($this->server->name) . '">' . e($this->server->name) . '</a>';
	}

}
