<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Vote extends Model {

	protected $fillable = [
		'user_id',
		'votable_id',
		'votable_type',
		'is'
	];

	public function votable() {
		return $this->morphTo();
	}

}
