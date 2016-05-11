<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;

use Stringy\StaticStringy as S;

class ServerGame extends Model
{

	protected $table = 'server_games';

	protected $fillable = [
		'name',
		'default_logo',
		'style_label',
	];

 	public function servers() {
 		return $this->hasMany('maze\GameServer');
 	}

 	public function getSlugAttribute($value)
	{
		if(!$value)
		{
			$value = $this->id . '-' . S::slugify($this->name);

			$this->slug = $value;
			$this->save();
			return $value;
		}
		else {
			return $value;
		}
	}
}
