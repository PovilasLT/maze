<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model {

	protected $fillable = [
		'node_id',
		'title',
		'body'
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

	//Pagrindinio puslapio topicai

	public static function frontPage() {
		$topics = Topic::orderBy('updated_at', 'DESC')->whereNull('deleted_at')->paginate(20);
		return $topics;
	}

}
