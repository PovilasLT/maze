<?php namespace maze;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

	protected $fillable = [
		'user_id',
		'from_id',
		'object_id',
		'object_type'
	];

	public static function getCount()
	{
		return Auth::user()->notification_count;
	}

	function user()
	{
		return $this->belongsTo('User');
	}

	function fromUser()
	{
		return $this->belongsTo('User', 'from_id', 'id');
	}

	public function scopeProfile($query) {
		return $query->latest()->whereNotIn('object_type', ['follow', 'status_comment']);
	}

	public function scopeLatest($query) {
		return $query->orderBy('created_at', 'DESC');
	}

	public function scopeMentions($query) {
		return $query->where('object_type', 'mention');
	}

	public function scopeTopics($query) {
		return $query->where('object_type', 'topic');
	}

	public function scopeReplies($query) {
		return $query->where('object_type', 'reply');
	}

	public function scopeStatuses($query) {
		return $query->where('object_type', 'status');
	}

	function getObjectAttribute()
	{
		$object = $this->object_type;

		switch ($object) {
			case 'topic':
				return Topic::find($this->object_id);
			case 'reply':
				return Reply::find($this->object_id);
			case 'status':
				return Status::find($this->object_id);
			case 'status_comment':
				return StatusComment::find($this->object_id);
			case 'mention':
				return Reply::find($this->object_id);
			case 'follow':
				return false;
			default:
				return false;
		}
	}

	function getIconAttribute()
	{
		$object = $this->object_type;

		switch ($object) {
			case 'topic':
				return 'fa-plus-square-o';
			case 'reply':
				return 'fa-arrow-circle-o-right';
			case 'status':
				return 'fa-comment-o';
			case 'status_comment':
				return 'fa-comments-o';
			case 'mention':
				return 'fa-at';
			case 'follow':
				return 'fa-user-plus';
			default:
				return false;
		}
	}

	function getBodyAttribute()
	{
		$object = $this->object_type;
		if ($object && is_object($this->object)) {
			return $this->object->body;
		} else
			return false;
	}

	function getTopicAttribute() {
		$object_type = $this->object_type;
		if($object_type == 'topic' || $object_type == 'reply' || $object_type == 'mention')
		{
			if($object_type == 'topic')
			{
				return $this->object;
			}
			else
			{
				return $this->object->topic;
			}
		}
		else
		{
			return false;
		}
	}

	function getUrlAttribute()
	{
		$object = $this->object_type;

		switch ($object) {
			case 'topic':
				return route('topic.show', [$this->object->slug, $this->object->id]);
			case 'reply':
				if ($this->object->topic)
					return route('topic.show', [$this->object->topic->slug, $this->object->topic->id]);
				else
					return false;
			case 'status':
				return route('status.show', [$this->object->id]);
			case 'status_comment':
				return route('status.show', [$this->object->status->id]);
			case 'mention':
				return route('topic.show', [$this->object->topic->slug, $this->object->topic->id]);
			case 'follow':
				return false;
			default:
				return false;
		}
	}

	function getNotificationAttribute()
	{
		$object = $this->object_type;
		switch ($object) {
			case 'topic':
				return 'Sukūrė temą <a href="' . $this->url . '" alt="' . e($this->object->title) . '" title="' . e($this->object->title) . '">' . e($this->object->title) . '</a>';
			case 'reply':
				if ($this->object->topic)
					return 'Parašė atsakymą į temą <a href="' . $this->url . '" alt="' . e($this->object->topic->title) . '" title="' . e($this->object->title) . '">' . e($this->object->topic->title) . '</a>';
				else
					return false;
			case 'status':
				return $this->body;
			case 'status_comment':
				if ($this->object->status)
					//rodyti tik komentarus i savo busenas.
					if ($this->object->status->user_id == Auth::user()->id)
						return 'Pakomentavo tavo <a href="' . $this->url . '">būsenos atnaujinimą</a>.';
					else
						return false;
				else
					return false;
			case 'mention':
				if ($this->object && $this->object->topic) {
					return 'Paminėjo tave temoje <a href="'.
					route('topic.show', [$this->object->topic->slug, $this->object->topic->id]).
					'">' . $this->object->topic->title . '</a>';
				} else {
					return false;
				}
			case 'follow':
				return false;
			default:
				return false;
		}
	}

	function getActivityAttribute()
	{
		$object = $this->object_type;
		switch ($object) {
			case 'topic':
				return 'Sukūrė temą <a href="' . $this->url . '" alt="' . e($this->object->title) . '" title="' . e($this->object->title) . '">' . e($this->object->title) . '</a>';
			case 'reply':
				if ($this->object->topic)
					return 'Parašė atsakymą į temą <a href="' . $this->url . '" alt="' . e($this->object->topic->title) . '" title="' . e($this->object->title) . '">' . e($this->object->topic->title) . '</a>';
				else
					return false;
			case 'status':
				return $this->body;
			case 'status_comment':
				if ($this->object->status)
					if ($this->object->status->user_id == $this->object->user_id)
						return 'Pakomentavo savo <a href="' . $this->url . '">būsenos atnaujinimą</a>.';

					else
						return 'Pakomentavo <a href="' . route('user.show', [$this->user->slug, $this->user->id]) . '" alt="' . $this->user->username . ' profilis" title="' . e($this->user->username) . ' profilis">' . e($this->user->username) . '</a> <a href="' . $this->url . '">būsenos atnaujinimą</a>.';
				else
					return false;
			case 'mention':
				return false;
			case 'follow':
				return 'Prenumeruoja narį <a href="' . route('user.show', [$this->user->slug, $this->user->id]) . '" alt="' . e($this->user->username) . ' profilis" title="' . e($this->user->username) . ' profilis">' . e($this->user->username) . '</a>';
			default:
				return false;
		}
	}


	function getIsReadAttribute() {
		$user = Auth::user();
		if($this->created_at->gte($user->notifications_read))
		{
			return false;
		}
		else {
			return true;
		}
	}

}
