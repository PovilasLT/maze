<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;
use maze\User;
use Auth;

class Conversation extends Model
{

	protected $fillable = [
		'secret',
	];

	public function users() 
	{
		return $this->belongsToMany('maze\User')->withTimestamps();
	}

	public function messages() 
	{
		return $this->hasMany('maze\Message');
	}

	public function pivots() 
	{
		return $this->hasMany('maze\UserConversationPivot');
	}

	public function pivot(User $user) 
	{
		return $this->hasMany('maze\UserConversationPivot')->where('user_id', $user->id);
	}

	public function scopeLatest($query) 
	{
		return $query->orderBy('updated_at', 'DESC');
	}

	public function hasUnread() {
		
	}

	public function scopeWithUsersAndMessages($query, $user)
	{
		return $query->with([
			'users' => function($users_query) use($user) {
				return $users_query->where('user_id', 'NOT LIKE', $user->id);
			},
			'messages' => function($messages_query) use($user) {
				return $messages_query->orderBy('created_at', 'DESC')->where('user_id', 'NOT LIKE', $user->id);
			}
		]);
	}

	public function getReceiverAttribute()
	{
		return $this->users()->where('user_id', 'NOT LIKE', Auth::user()->id)->first();
	}

	public function getSecretAttribute($value)
	{
		if(!$value) {
			$secret = str_random(70);
			$this->secret = str_random(70);
			$this->save();
			return $secret;
		} else {
			return $value;
		}
	}

}
