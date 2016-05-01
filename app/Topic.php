<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Config;
use Stringy\StaticStringy as S;

class Topic extends Model {

	protected $morphClass = 'Topic';

	protected $appends = [
		'node',
	];

	protected $fillable = [
		'node_id',
		'title',
		'body',
		'body_original',
		'user_id',
		'type',
	];

	use SoftDeletes;

	public $view = 'topic.item';

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

	public function notifications() {
		return $this->morphMany('Notification', 'object');
	}

	public function mentions() {
		return $this->morphMany('Mention', 'object');
	}

	public function votes() {
		return $this->morphMany('Vote', 'votable');
	}

	public function scopeUser($query, $user) {
		return $query->whereNested(function($query) use ($user) {
				$query->where('user_id', '=', $user->id)->orWhereExists(function($query) use ($user) {
				$query->select('id')->from('replies')->where('replies.user_id', '=', $user->id)->whereRaw('topics.id = replies.topic_id');
			});
		});
	}

	public function scopePopular($query) {
		return $query->orderBy('weight', 'DESC')->latest();
	}

	public function scopeLatest($query) {
		return $query->orderBy('created_at', 'DESC');
	}

	public function scopeLatestPost($query) {
		return $query->orderByRaw('(select created_at from replies where topic_id = topics.id order by created_at desc limit 1) desc');
	}

	public function scopeGames($query) {
		$user = Auth::user();

		if($user) {
			return $query->whereIn('node_id', $user->frontPageNodes());
		}
		else {
			return $query->whereIn('node_id', Node::frontPageNodes());
		}
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
		}, 'replies.user']);
	}

	//Pagrindinio puslapio topicai

	public static function scopeFrontPage($query, $sort) {
		if($sort == 'populiariausi' || !$sort)
		{
			return $query->games()->pinned()->popular()->withReplies();
		}
		else if($sort == 'mano-turinys')
		{
			return $query->games()->pinned()->user(Auth::user())->latestPost()->withReplies();
		}
		else if($sort == 'naujausi-pranesimai')
		{
			return $query->games()->pinned()->latestPost()->withReplies();
		}
		else
		{
			return $query->games()->pinned()->latest()->withReplies();
		}
	}

	public function scopeWithVotes($query) {
		return $query->with(['votes']);
	}

	// Sidebar skelbimai
	public static function scopeMarket($query)
	{
		return $query->whereIn('node_id', Node::marketNodes())->orderBy('id', 'desc')->limit(config('app.advertisements'));
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
			return '<span class="maze-label label-diskusija media-meta-element"><i class="fa fa-comments-o fa-fw"></i><span class="hidden-xs">Diskusija</span></span>';
		elseif($type == 215)
			return '<span class="maze-label label-pranesimas media-meta-element"><i class="fa fa-exclamation fa-fw"></i><span class="hidden-xs">Pranešimas</span></span>';
		elseif($type == 2)
			return '<span class="maze-label label-klausimas media-meta-element"><i class="fa fa-question fa-fw"></i><span class="hidden-xs">Klausimas</span></span>';
		elseif($type == 3)
			return '<span class="maze-label label-apklausa media-meta-element"><i class="fa fa-trophy fa-fw"></i><span class="hidden-xs">Konkursas</span></span>';
		elseif($type == 4)
			return '<span class="maze-label label-video media-meta-element"><i class="fa fa-youtube-play fa-fw"></i><span class="hidden-xs">Video</span></span>';
		elseif($type == 5)
			return '<span class="maze-label label-stream media-meta-element"><i class="fa fa-twitch fa-fw"></i><span class="hidden-xs">Stream</span></span>';
		elseif($type == 6)
			return '<span class="maze-label label-play media-meta-element"><i class="fa fa-gamepad fa-fw"></i><span class="hidden-xs">Kviečiu Žaisti</span></span>';
		elseif($type == 7)
			return '<span class="maze-label label-spam media-meta-element"><i class="fa fa-star fa-fw"></i><span class="hidden-xs">Pristatymas</span></span>';
		elseif($type == 8)
			return '<span class="maze-label label-gallery media-meta-element"><i class="fa fa-picture-o fa-fw"></i><span class="hidden-xs">Paveikslėliai</span></span>';
		elseif($type == 9)
			return '<span class="maze-label label-lesson media-meta-element"><i class="fa fa-graduation-cap fa-fw"></i><span class="hidden-xs">Pamoka</span></span>';
		else 
			return '<span class="maze-label label-diskusija media-meta-element"><i class="fa fa-comments-o fa-fw"></i><span class="hidden-xs">Diskusija</span></span>';
	}

	public function voted($type, $user = null) {
		if($user || $user = Auth::user())
		{
			$vote = $this->votes->where('user_id', $user->id)->first();
			if($vote && $vote->is == $type.'vote')
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
