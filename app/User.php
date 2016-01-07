<?php namespace maze;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use maze\Vote;
use Auth;
use Stringy\StaticStringy as S;
use Cache;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 
		'email', 
		'password', 
		'sex', 
		'steam', 
		'about_me', 
		'twitter', 
		'youtube', 
		'twitch', 
		'city', 
		'email_replies', 
		'email_messages', 
		'email_news', 
		'message_count',
		'namechange_seen',
		'name_changes',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $dates = ['created_at', 'updated_at', 'last_login', 'last_action', 'notifications_read', 'dob', 'last_reply_emailed'];

	public $information = [
		'city',
		'sex',
		'twitter',
		'steam',
		'twitch',
		'youtube',
	];

	public function topics() {
		return $this->hasMany('maze\Topic');
	}

	public function replies() {
		return $this->hasMany('maze\Reply');
	}
	
	public function statuses() {
		return $this->hasMany('maze\Notification')->where('object_type', 'status');
	}

	public function followers() {
		return $this->hasMany('maze\Follower');
	}

	public function following() {
		return $this->hasMany('maze\Follower', 'follower_id', 'id');
	}

	public function notifications() {
		return $this->hasMany('maze\Notification');
	}

	public function activities() {
		return $this->hasMany('maze\Notification')->whereNotIn('object_type', ['follow'])->where('from_id', $this->id);
	}

	public function messages() {
		return $this->hasMany('maze\Message');
	}

	public function conversations() {
		return $this->belongsToMany('maze\Conversation')->withTimestamps()->withPivot('read_at');
	}

	public function jointConversations($user)
	{
		return $this->conversations()->whereIn('id', $user->conversations()->lists('id'));
	}

	//Patikrina ar User jau balsavo uz tam tikra turini.
	//Jei balsavo - grazina Vote objekta
	//Jei nebalsavo - grazina false

	public function hasVoted($id, $votable) {
		$vote = Vote::where('votable_type', $votable)
		->where('votable_id', $id)
		->where('user_id', $this->id)
		->first();
		return $vote;
	}

	//User gali balsuoti uz temas ir pranesimus per User->vote();

	public function vote($id, $votable, $type) {
		//patikrinti ar gali balsuoti
		if($this->can_vote)
		{
			$vote = $this->hasVoted($id, $votable);

			//patikrinti ar zmogus jau balsavo
			if($vote)
			{
				//pasalina pries tai buvusi balsa
				$vote->delete();
			}

			//balsuoja is naujo
			Vote::create([
				'votable_type' 	=> $votable,
				'votable_id'	=> $id,
				'user_id'		=> $this->id,
				'is'			=> $type
			]);
		}
	}

	/**
	 * Patikrina ar prisijungęs vartotojas seka žmogų.
	 * @return Follower gražina Follower objektą.
	 */
	public function getIsFollowingAttribute()
	{
		if(Auth::check())
		{
			$user = Auth::user();
			$follower = Follower::where('user_id', $this->id)->where('follower_id', $user->id)->first();

			return $follower;
		}
		else
		{
			return false;
		}
	}

	public function getFollowerListAttribute() {
		return $this->following()->lists('user_id');
	}

	public function getAvatarAttribute($value)
	{
		$value = $this->image_url;
		if($value)
		{
			$url = '/images/avatars/'.$this->id.'/'.$value;
			if(file_exists('../public/images/avatars/'.$this->id.'/'.$value))
			{
				return $url;
			}
			else 
			{
				return '/images/avatars/no_avatar.png';
			}
		}
		else
		{
			$url = '/images/avatars/no_avatar.png';
		}

		return $url;
	}


	public function getSlugAttribute($value)
	{
		if( ! $value)
		{
			$value = S::slugify($this->username);

			$nodes = User::where('slug', $value);

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
			$slugs = User::where('slug', $value)->count();
			$slug = $value;
			if($slugs > 0)
			{
				$slug = $value.$this->id;
				$this->update(['slug' => $slug]);
			}
			return $slug;
		}
	}
	
	public function getUrlAttribute()
	{
		return route('user.show', $this->slug);
	}

	public function getSexAttribute($value) {
		if($value == 0)
		{
			return 'Moteris';
		}
		else
		{
			return 'Vyras';
		}
	}

	public function getTwitterAttribute($value)
	{
		return '@'.$value;
	}

	public function getSteamAttribute()
	{
		return 'Nuoroda';
	}

	public function getYoutubeAttribute()
	{
		return 'Nuoroda';
	}

	public function getAboutMeAttribute($value)
	{
		return str_limit($value, 255, '[...]');
	}

	public function getRoleAttribute()
	{
		if($this->roles->isEmpty()) {
			$this->attachRole(Role::where('name', '=', 'Narys')->get()->first());
		}
		return $this->roles->first()->name;
	}

	public function getIsStaffAttribute()
	{
		$role = $this->roles->first();

		if(($role->id ==  1) || ($role->id ==  2) || ($role->id ==  3))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getHasAboutAttribute()
	{
		foreach($this->information as $field)
		{
			if($this->getOriginal($field))
			{
				return true;
			}
		}
		
		return false;
	}

	public function readableField($field)
	{
		switch ($field) {
			case 'sex':
				return 'Lytis';
			case 'city':
				return 'Miestas';
			case 'dob':
				return 'Amžius';
			default:
				return ucfirst($field);
				break;
		}
	}

	public function fieldLink($field)
	{
		switch ($field) {
			case 'twitter':
				return 'http://twitter.com/'.$this->getOriginal($field);
			case 'steam':
				return $this->getOriginal($field);
			case 'youtube':
				return $this->getOriginal($field);
			case 'facebook':
				return 'http://facebook.com/'.$this->getOriginal($field);
			case 'twitch':
				return 'http://twitch.tv/'.$this->getOriginal($field);
			case 'hitbox':
				return 'http://hitbox.tv/'.$this->getOriginal($field);
			case 'deviantart':
				return 'http://'.$this->getOriginal($field).'.deviantart.com/';
			case 'website':
				return $this->getOriginal($field);
			default:
				return false;
				break;
		}
	}

	public function follow() {

		$follower = $this->is_following;

		if(!$follower)
		{
			Follower::create([
				'user_id' => $this->id,
				'follower_id' => Auth::user()->id
			]);

			$this->increment('follower_count');

			return true;
		}
		else
		{
			$follower->delete();
			$this->decrement('follower_count');
			return false;
		}
	}
	
}
