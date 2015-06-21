<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class PollVote extends Model {

	protected $fillable = [
		'user_id',
		'answer_id',
		'poll_id'
	];

	protected $table = 'poll_votes';

	public function poll() 
	{
		return $this->belongsTo('maze\Poll');
	}

	public function user() 
	{
		return $this->belongsTo('maze\User');
	}

	public function answer()
	{
		return $this->belongsTo('maze\Answer');
	}
}