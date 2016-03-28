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
		'is_read',
	];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function fromUser()
	{
		return $this->belongsTo('User', 'from_id', 'id');
	}

	public function reply()
	{
		return $this->belongsTo('Reply', 'object_id', 'id')->where('object_type', 'Reply');
	}

	public function mention()
	{
		return $this->belongsTo('Mention', 'object_id', 'id')->where('object_type', 'Mention');
	}

	public function status()
	{
		return $this->belongsTo('Status', 'object_id', 'id')->where('object_type', 'Status');
	}

	public function topic()
	{
		return $this->belongsTo('Topic', 'object_id', 'id')->where('object_type', 'Topic');
	}

	public function statusComment()
	{
		return $this->belongsTo('StatusComment', 'object_id', 'id')->where('object_type', 'StatusComment');
	}

	public function object() {
		return $this->morphTo();
	}

	public function scopeMentionExists($query)
	{
		return $query->whereExists(function($q) {
			return $q->select(\DB::raw(1))->from('mentions')->whereRaw('`notifications`.`object_id` = `mentions`.`id`');
		});
	}

	public function scopeReplyExists($query)
	{
		return $query->whereExists(function($q) {
			return $q->select(\DB::raw(1))->from('replies')->whereRaw('`notifications`.`object_id` = `replies`.`id`')
			->whereExists(function($q_topics) {
				return $q_topics->select(\DB::raw(1))->from('topics')->whereRaw('`replies`.`topic_id` = `topics`.`id`');
			});
		});
	}

	public function scopeTopicExists($query)
	{
		return $query->whereExists(function($q) {
			return $q->select(\DB::raw(1))->from('topics')->whereRaw('`notifications`.`object_id` = `topics`.`id`');
		});
	}

	public function scopeStatusExists($query)
	{
		return $query->whereExists(function($q) {
			return $q->select(\DB::raw(1))->from('statuses')->whereRaw('`notifications`.`object_id` = `statuses`.`id`');
		});
	}

	public function scopeHasAll($query)
	{
		$query->whereRaw("((select count(*) from `topics` where `notifications`.`object_id` = `topics`.`id` and `topics`.`deleted_at` is null and `object_type` = 'Topic') >= 1 or (select count(*) from `replies` where `notifications`.`object_id` = `replies`.`id` and (select count(*) from `topics` where `replies`.`topic_id` = `topics`.`id` and `topics`.`deleted_at` is null) >= 1 and `object_type` = 'Reply') >= 1 or (select count(*) from `statuses` where `notifications`.`object_id` = `statuses`.`id` and `object_type` = 'Status') >= 1 or (select count(*) from `statuses` where `notifications`.`object_id` = `statuses`.`id` and `object_type` = 'Status') >= 1)");
	}

	public function scopeFollowing($query) {
		$users = Auth::user()->follower_list;
		return $query->whereIn('from_id', $users);
	}

	public function scopeActivities($query, $id) {
		return $query->where('from_id', $id);
	}

	public function scopeLatest($query) {
		return $query->orderBy('created_at', 'DESC')->orderBy('is_read', 'DESC');
	}

	public function scopeMentions($query) {
		return $query->where('user_id', Auth::user()->id)->where('object_type', 'Mention');
	}

	public function scopeTopics($query) {
		return $query->where('object_type', 'Topic');
	}

	public function scopeReplies($query) {
		return $query->where('object_type', 'Reply');
	}

	public function scopeStatuses($query) {
		return $query->where('object_type', 'Status');
	}

	function getUrlAttribute()
	{
		return $this->object->url;
	}

	function getNotificationAttribute()
	{
		return $this->object->notification;
	}

	function getActivityAttribute()
	{
		return $this->object->activity;
	}
}
