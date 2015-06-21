<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use maze\PollVote;

class Answer extends Model {

	protected $fillable = [
		'poll_id',
		'title'
	];

	public function poll()
	{
		return $this->belongsTo('maze\Poll');
	}

	public function votes()
	{
		return $this->hasMany('maze\PollVote');
	}

	public function percentage()
	{
		$total = $this->poll->votes()->count();
		$votes = $this->votes()->count();
		if($total != 0)
		{
			$percentage = (100 * $votes) / $total;
		}
		else
		{
			return 0;
		}
	}

}