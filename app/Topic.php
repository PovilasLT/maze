<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Config;
use Stringy\StaticStringy as S;

class Topic extends Model {

	protected $fillable = [
		'node_id',
		'title',
		'body',
		'body_original',
		'user_id',
		'type',
		// 'updated_at',
	];

	use SoftDeletes;

	public function replies() {
		return $this->hasMany('maze\Reply');
	}

	public function user() {
		return $this->belongsTo('maze\User');
	}

	public function node() {
		return $this->belongsTo('maze\Node');
	}

	public function poll() {
		return $this->hasOne('maze\Poll');
	}

	//Scope

	public function scopePopular($query) {
		return $query->orderBy('weight', 'DESC')->latest();
	}

	public function scopeLatest($query) {
		return $query->orderBy('created_at', 'DESC');
	}

	public function scopeGames($query) {
		return $query->whereIn('node_id', Config::get('app.front_page_nodes'));
	}

	public function scopePinnedLocal($query)
	{
		return $query->orderBy('pin_local', 'DESC');
	}

	public function scopePinned($query)
	{
		return $query->orderBy('order', 'DESC');
	}

	public function scopeWithReplies($query)
	{
		return $query->with(['replies' => function($replies_query) {
			return $replies_query->orderBy('created_at', 'DESC');
		}]);
	}

	public function notifications() {
		return Notification::where('object_type', 'topic')
							->where('object_id', $this->id)
							;
	}

	//Pagrindinio puslapio topicai

	public static function frontPage($sort) {
		if($sort == 'populiariausi' || !$sort)
		{
			$topics = Topic::games()->pinned()->popular()->withReplies()->paginate(20);
		}
		else
		{
			$topics = Topic::games()->pinned()->latest()->withReplies()->paginate(20);
		}
		return $topics;
	}

	public function sameNodeTopics() {
		$topics = Topic::where('node_id', $this->node_id)->where('id', '<>', $this->id)->take('10')->get();
		return $topics;
	}

	public function getSlugAttribute($value)
	{
		if( ! $value)
		{
			$value = $this->id . '-' . S::slugify($this->title);

			$nodes = Topic::where('slug', $value);

			if($nodes->count() > 0)
			{
				$value = $this->id . '-' . $value;
				$this->slug = $value;

				$this->save();

				return $value;
			}
			else {
				$this->slug = $value;

				$this->save();

				return $value;
			}
		}
		else {
			return $value;
		}
	}

	public function getFullTypeAttribute($value)
	{
		$type = $this->type;

		if($type == 0)
			return '<span class="maze-label label-diskusija media-meta-element"><i class="fa fa-comments-o"></i> Diskusija</span>';
		elseif($type == 215)
			return '<span class="maze-label label-pranesimas media-meta-element"><i class="fa fa-bullhorn"></i> Pranešimas</span>';
		elseif($type == 2)
			return '<span class="maze-label label-klausimas media-meta-element"><i class="fa fa-question"></i> Klausimas</span>';
		elseif($type == 3)
			return '<span class="maze-label label-apklausa media-meta-element"><i class="fa fa-trophy"></i> Konkursas</span>';
		elseif($type == 4)
			return '<span class="maze-label label-video media-meta-element"><i class="fa fa-youtube-play"></i> Video</span>';
		elseif($type == 5)
			return '<span class="maze-label label-stream media-meta-element"><i class="fa fa-twitch"></i> Stream</span>';
		elseif($type == 6)
			return '<span class="maze-label label-play media-meta-element"><i class="fa fa-gamepad"></i> Kviečiu Žaisti</span>';
		elseif($type == 7)
			return '<span class="maze-label label-spam media-meta-element"><i class="fa fa-star"></i> Pristatymas</span>';
		else 
			return '<span class="maze-label label-diskusija media-meta-element"><i class="fa fa-comments-o"></i> Diskusija</span>';
	}

	public function voted($type) {
		if(Auth::check())
		{
			$user = Auth::user();
			$vote = Vote::where('votable_id', $this->id)->where('votable_type', 'Topic')->where('user_id', $user->id)->where('is', $type.'vote')->first();
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

	public function nodePath() {
		$parent = $this->node->parent;
		$parent = '<a href="'.route('node.show', $parent->slug).'">'.$parent->name.'</a>';
		$node = $this->node;
		$node = '<a href="'.route('node.show', $node->slug).'">'.$node->name.'</a>';
		return $parent.' &raquo '.$node;
	}


	public function getUrlAttribute() {
		return route('topic.show', $this->slug);
	}

	public function getNotificationAttribute() {
		return 'Sukūrė temą <a href="' . $this->url . '" alt="' . e($this->title) . '" title="' . e($this->title) . '">' . e($this->title) . '</a>';
	}

	public function getActivityAttribute() {
		return 'Sukūrė temą <a href="' . $this->url . '" alt="' . e($this->title) . '" title="' . e($this->title) . '">' . e($this->title) . '</a>';
	}

}
