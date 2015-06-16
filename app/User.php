<?php namespace maze;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use maze\Vote;

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
	protected $fillable = ['username', 'email', 'password', 'sex', 'dob'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	public function topics() {
		return $this->hasMany('Topic');
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
	
}
