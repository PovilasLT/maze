<?php namespace maze;

use Illuminate\Database\Eloquent\Model;

class StatusComment extends Model {

	protected $table = 'status_comments';

	public function status() {
		return $this->belongsTo('maze\Status');
	}

	public function user() {
		return $this->belongsTo('maze\User');
	}

}
