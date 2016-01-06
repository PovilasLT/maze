<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Notification extends Model {

	protected $fillable = [
		'user_id',
		'from_id',
		'object_id',
		'object_type',
		'updated_at',
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

	public function scopeFollowing($query) {
		$users = Auth::user()->follower_list;
		$users[] = Auth::user()->id;
		return $query->whereIn('from_id', $users);
	}

	public function scopeLatest($query) {
		return $query->orderBy('created_at', 'DESC');
	}

	public function scopeMentions($query) {
		return $query->where('object_type', 'mention')->where('user_id', Auth::user()->id);
	}

	public function scopeTopics($query) {
		return $query->where('object_type', 'topic');
	}

	public function scopeReplies($query) {
		return $query->where('object_type', 'reply');
	}

	public function scopeStatuses($query) {
		return $query->whereIn('object_type', ['status', 'status_comment']);
	}

	function getNotifiedInAttribute() {
		$object = 'maze\\'.studly_case($this->object_type);
		$object = $object::findOrFail($this->object_id);
		return $object;
	}

	function getUrlAttribute()
	{
		return $this->notified_in->url;
	}

	function getNotificationAttribute()
	{
		return $this->notified_in->notification;
	}

	function getActivityAttribute()
	{
		return $this->notified_in->activity;
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
