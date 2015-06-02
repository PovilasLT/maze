<?php namespace maze;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

	protected $fillable = [
		'user_id',
		'topic_id',
		'body'
	];

	public function user() {
		return $this->belongsTo('maze\User');
	}

	public function topic() {
		return $this->belongsTo('maze\Topic');
	}
	
}
