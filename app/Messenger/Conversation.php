<?php

namespace maze\Messenger;

use Illuminate\Database\Eloquent\Model;
use maze\User;
use Auth;

class Conversation extends Model
{

    protected $fillable = [
        'secret',
    ];

    public function users()
    {
        return $this->belongsToMany('maze\User');
    }

    public function messages()
    {
        return $this->hasMany('maze\Messenger\Message');
    }

    public function scopeJoint($query, array $user_ids)
    {
        return $query
        ->rightJoin('conversation_user', 'conversation_user.conversation_id', '=', 'conversations.id')
        ->where('conversation_user.user_id', $user_ids[0])
        ->whereIn('conversation_user.conversation_id', function ($query) use ($user_ids) {
            return $query
            ->select('conversation_user.conversation_id')
            ->from('conversation_user')
            ->where('conversation_user.user_id', $user_ids[1]);
        });
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('updated_at', 'DESC');
    }

    public function scopeWithUsersAndMessages($query, $user)
    {
        return $query->with([
            'users' => function ($users_query) use ($user) {
                return $users_query->where('user_id', 'NOT LIKE', $user->id);
            },
            'messages' => function ($messages_query) use ($user) {
                return $messages_query->orderBy('created_at', 'DESC')->where('user_id', 'NOT LIKE', $user->id);
            }
        ]);
    }

    public function getReceiverAttribute()
    {
        return $this->users()->where('user_id', 'NOT LIKE', Auth::user()->id)->first();
    }

    public function getUnreadCountAttribute()
    {
        return $this->messages()->where('user_id', '<>', Auth::user()->id)->where('is_read', 0)->count();
    }
}
