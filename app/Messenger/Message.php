<?php

namespace maze\Messenger;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
    	'user_id',
    	'conversation_id',
    	'body',
    	'body_original',
        'is_read',
    ];

    public function conversation() {
    	return $this->belongsTo('maze\Messenger\Conversation');
    }

    public function user() {
    	return $this->belongsTo('maze\User');
    }

    public function scopeLatest($query) {
        return $query->orderBy('created_at', 'DESC');
    }
}
