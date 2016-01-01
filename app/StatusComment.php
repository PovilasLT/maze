<?php namespace maze;

use Illuminate\Database\Eloquent\Model;

class StatusComment extends Model {

	protected $table = 'status_comments';

	protected $fillable = [
		'user_id',
		'status_id',
		'body',
		'body_original'
	];

	public function status() {
		return $this->belongsTo('maze\Status');
	}

	public function user() {
		return $this->belongsTo('maze\User');
	}

	public function getBodyOriginalAttribute($value) {
		if($value)
		{
			return $value;
		}
		else
		{
			return $this->body;
		}
	}

	public function rules()
	{
		return [
			'id'		=> 'required|exists:status_comments,id',
			'body'		=> 'required|min:10'
		];
	}

	public function attributes()
	{
		$nice_names = [
            'id'  			=> 'būsenos komentaras',
            'body'  		=> 'turinys',
        ];
        return $nice_names;
	}

	public function getParentContainerAttribute() {
		return $this->status;
	}

}
