<?php

namespace maze;

use Illuminate\Database\Eloquent\Model;

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

    public function getUrlAttribute() {
        return $this->mentioned_in->url;
    }

    public function getNotificationAttribute() {
        switch ($this->object_type) {
            case 'Reply':
                    return 'Paminėjo <a href="'.$this->user->url.'">'.e($this->user->username).'</a> savo <a href="'.$this->url.'">pranešime</a>, temoje <a href="'. $this->mentioned_in->topic->url.'">'.e($this->mentioned_in->topic->title).'</a>.';
                break;
            case 'Topc':
                    return 'Paminėjo <a href="'.$this->user->url.'">'.e($this->user->username).'</a> temoje <a href="'.$this->url.'">'.e($this->mentioned_in->title).'.</a>';
                break;
            case 'Status':
                    return 'Paminėjo <a href="'.$this->user->url.'">'.e($this->user->username).'</a> <a href="'.$this->url.'">būsenos atnaujinime</a>.';
                break;
            case 'StatusComment':
                    return 'Paminėjo <a href="'.$this->user->url.'">'.e($this->user->username).'</a> <a href="'.$this->mentioned_in->status->url.'">būsenos atnaujinimo</a> <a href="'.$this->url.'">komentare</a>.';
                break;
            default:
                    return false;
                break;
        }
    }

    public function getMentionedInAttribute() {
        $object_type = 'maze\\'.$this->object_type;
        $object = $object_type::findOrFail($this->object_id);
        return $object;
    }

    public function getActivityAttribute() {
        return false;
    }
}
