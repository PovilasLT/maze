<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Poll extends Model {

	protected $fillable = [
		'topic_id'
	];

	public function votes()
	{
		return $this->hasMany('maze\PollVote');
	}

	public function topic()
	{
		return $this->belongsTo('maze\Topic');
	}

	public function user()
	{
		return $this->belongsTo('maze\User');
	}

	public function answers()
	{
		return $this->hasMany('maze\Answer');
	}

	public function hasVoted()
	{
		if(Auth::check())
		{
			$user = Auth::user();
			return $this->answers()->where('user_id', $user->id)->first();
		}
		else
		{
			return false;
		}
	}

	public function vote($id)
	{
		
	}
}