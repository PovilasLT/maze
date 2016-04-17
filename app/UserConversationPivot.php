<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;
use maze\User;

class UserConversationPivot extends Model
{
	protected $table = 'conversation_user';

    protected $fillable = [
    	'read_at',
    ];

    protected $dates = [
    	'created_at',
    	'updated_at',
    	'read_at',
    ];

    public function conversation(User $user)
    {
    	return $this->belongsTo('maze\Conversation')->where('user_id', $user->id);
    }

    public function user()
    {
        return $this->belongsTo('maze\User');
    }

}
