<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;

use \maze\Traits\Notifiable;

class Reply extends Model {

	use \maze\Traits\Notifiable;

	protected $fillable = [
		'user_id',
		'topic_id',
		'body',
		'body_original'
	];

	public function user() {
		return $this->belongsTo('maze\User');
	}

	public function topic() {
		return $this->belongsTo('maze\Topic');
	}

	public function getUrlAttribute()
	{
		
	}

	public function notifications() {
		return Notification::where('object_type', 'reply')
							->orWhere('object_type', 'mention')
							->where('object_id', $this->id)
							;
	}

	public function voted($type) {
		if(Auth::check())
		{
			$user = Auth::user();
			$vote = Vote::where('votable_id', $this->id)->where('votable_type', 'Reply')->where('user_id', $user->id)->where('is', $type.'vote')->first();
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
