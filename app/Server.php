<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;
use maze\ServerGame;

use Auth;
use Stringy\StaticStringy as S;
use Storage;

class Server extends Model
{

	protected $morphClass = 'Server';
    protected $table = 'servers';

    protected $fillable = [
    	'name',
    	'ip',
    	'port',
    	'user_id',
    	'body',
    	'body_original',
    	'site',
    	'game_id',
    	'logo',
    ];


    public function game() {
    	return $this->belongsTo('maze\ServerGame', 'game_id', 'id');
    }

    public function user() {
    	return $this->belongsTo('maze\User');
    }

    public function votes() {
		return $this->morphMany('Vote', 'votable');
	}

	public function comments() {
		return $this->hasMany('maze\ServerComment');
	}

    public function getLogoAttribute($logo) {
    	if(!$logo || !Storage::disk('public')->has('images/servers/'.$logo)) 
    	{
    		$type = ServerGame::find($this->game_id);
    		if($type && $type->default_logo)
    			$logo = $type->default_logo;
    		else 
    			$logo = "no_logo.png";
    		return "/images/servers/default/".$logo;
    	}
    	else
    		return "/images/servers/".$logo;
    }

    public function getSlugAttribute($value)
	{
		if(!$value)
		{
			$value = $this->id . '-' . S::slugify($this->name);

			$this->slug = $value;
			$this->save();
			return $value;
		}
		else {
			return $value;
		}
	}

    public function scopeConfirmed($query) {
    	return $query->where('is_confirmed', '=', '1');
    }

    public function scopeUnconfirmed($query) {
    	return $query->where('is_confirmed', '=', '0');
    }

    public function scopeLatest($query) {
    	return $query->orderByRaw('created_at desc,(select created_at from server_comments where server_id = servers.id order by created_at desc limit 1) desc');
    }

    public function scopePopular($query) {
		return $query->orderBy('vote_count', 'DESC');
	}

	public function scopeGames($query, ServerGame $game) {
		return $query->where('game_id', '=', $game->id);
	}

    // Kopijuota iš maze\Topic.php
    public function voted($type, $user = null) {
		if($user || $user = Auth::user())
		{
			if(!$user)
				$user = Auth::user();
			$vote = $this->votes->where('user_id', $user->id)->first();
			//var_dump($vote);
			//exit;
			if($vote && $vote->is == $type.'vote')
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
