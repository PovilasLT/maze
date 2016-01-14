<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Reply extends Model {

	protected $fillable = [
		'user_id',
		'topic_id',
		'body',
		'body_original'
	];

	protected $dates = [
		'created_at',
		'updated_at',
	];

	public function user() {
		return $this->belongsTo('maze\User');
	}

	public function topic() {
		return $this->belongsTo('maze\Topic');
	}

	public function notifications() {
		return $this->morphMany('Notification', 'object');
	}

	public function mentions() {
		return $this->morphMany('Mention', 'object');
	}
	
	public function scopeLatest($query)
	{
		return $query->orderBy('created_at', 'DESC');
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

	public function getParentContainerAttribute() {
		return $this->topic;
	}

	public function getUrlAttribute() {
		return $this->topic->url.'#pranesimas-'.$this->id;
	}

	public function getNotificationAttribute() {
		return 'Parašė <a href="'.$this->url.'">atsakymą</a> į temą <a href="' . $this->topic->url . '" alt="' . e($this->topic->title) . '" title="' . e($this->topic->title) . '">' . e($this->topic->title) . '</a>';
	}

	public function getActivityAttribute() {
		return 'Parašė <a href="'.$this->url.'">atsakymą</a> į temą <a href="' . $this->topic->url . '" alt="' . e($this->topic->title) . '" title="' . e($this->topic->title) . '">' . e($this->topic->title) . '</a>';
	}
	
}
