<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

	public function getUrlAttribute() {
		return route('status.show', $this->status_id).'#komentaras-'.$this->id;
	}

	public function getActivityAttribute() {
		if ($this->status->user_id == Auth::user()->id)
		{
			return 'Pakomentavo tavo <a href="' . $this->url . '">būsenos atnaujinimą</a>.';
		}
		else
		{
			return false;
		}
	}

	public function getNotificationAttribute() {
		if ($this->status)
		{
			if ($this->status->user_id == $this->user_id)
			{
				return '<a href="'.$this->url.'">Pakomentavo</a> savo <a href="' . $this->status->url . '">būsenos atnaujinimą</a>.';
			}
			else
			{
				return '<a href="'.$this->url.'">Pakomentavo</a> <a href="' .$this->status->user->url. ' profilis" title="' . e($this->status->user->username) . ' profilis">' . e($this->status->user->username) . '</a> <a href="' . $this->status->url . '">būsenos atnaujinimą</a>.';
			}
		}
		else
		{
			return false;
		}
	}

}
