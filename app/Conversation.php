<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Conversation extends Model
{

	protected $fillable = [
		'secret',
	];

	public function users() {
		return $this->belongsToMany('maze\User')->withTimestamps();
	}

	public function messages() {
		return $this->hasMany('maze\Message');
	}

	public function scopeLatest($query) {
		return $query->orderBy('updated_at', 'DESC');
	}

	public function hasUnread() {
		
	}

	public function getReceiverAttribute()
	{
		return $this->users()->where('user_id', 'NOT LIKE', Auth::user()->id)->first();
	}

	public function getSecretAttribute($value)
	{
		if(!$value)
		{
			$secret = str_random(70);
			$this->secret = str_random(70);
			$this->save();
			return $secret;
		}
		else
		{
			return $value;
		}
	}

}
