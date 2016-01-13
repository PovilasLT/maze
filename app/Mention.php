<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Mention extends Model
{
    protected $fillable = [
    	'user_id',
    	'object_id',
    	'object_type',
    ];

    public function user() {
    	return $this->belongsTo('maze\User');
    }

    public function object() {
        return $this->morphTo();
    }

    public function notifications() {
        return $this->morphMany('Notification', 'object');
    }


    public function mentions() {
        return $this->morphMany('Mention', 'object');
    }

    public function getUrlAttribute() {
        return $this->mentioned_in->url;
    }

    public function getNotificationAttribute() {

        if($this->user_id == Auth::user()->id)
        {
            $username = 'tave';
        }
        else
        {
            $username = '<a href="'.$this->user->url.'">'.e($this->user->username).'</a>';
        }

        switch ($this->object_type) {
            case 'Reply':
                    return 'Paminėjo '.$username.' savo <a href="'.$this->url.'">pranešime</a>, temoje <a href="'. $this->mentioned_in->topic->url.'">'.e($this->mentioned_in->topic->title).'</a>.';
                break;
            case 'Topc':
                    return 'Paminėjo '.$username.' temoje <a href="'.$this->url.'">'.e($this->mentioned_in->title).'.</a>';
                break;
            case 'Status':
                    return 'Paminėjo '.$username.' <a href="'.$this->url.'">būsenos atnaujinime</a>.';
                break;
            case 'StatusComment':
                    return 'Paminėjo '.$username.' <a href="'.$this->mentioned_in->status->url.'">būsenos atnaujinimo</a> <a href="'.$this->url.'">komentare</a>.';
                break;
            default:
                    return false;
                break;
        }
    }

    public function getMentionedInAttribute() {
        return $this->object;
    }

    public function getActivityAttribute() {
        return false;
    }
}
