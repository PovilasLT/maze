<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use maze\Notification;
use \maze\Traits\Notifiable;


class Status extends Model {

	use \maze\Traits\Notifiable;


	protected $fillable = [
		'user_id',
		'body',
		'body_original'
	];

	public function statusComments() {
		return $this->hasMany('maze\StatusComment');
	}

	public function user() {
		return $this->belongsTo('maze\User');
	}

	public function notifications() {
		return Notification::where('object_type', 'status')
							->where('object_id', $this->id)
							;
	}

}
