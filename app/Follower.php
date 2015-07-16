<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use \maze\Traits\Notifiable;

class Follower extends Model {

	use \maze\Traits\Notifiable;

	protected $fillable = [
        'user_id',
        'follower_id'
    ];

    protected $visible = [
        'user_id',
        'follower_id',
        'created_at',
        'updated_at',
        'id'
    ];

    public function user() {
        return $this->belongsTo('maze\User');
    }

    public function follower() {
        return $this->belongsTo('maze\User', 'follower_id', 'id');
    }

}
