<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use maze\Notification;
use \maze\Traits\Notifiable;
use Markdown;
use Auth;
use Cache;

class Status extends Model
{

    protected $fillable = [
        'user_id',
        'body',
        'body_original'
    ];

    public $view = 'status.item';

    public function statusComments()
    {
        return $this->hasMany('maze\StatusComment');
    }

    public function comments()
    {
        return $this->hasMany('maze\StatusComment');
    }

    public function user()
    {
        return $this->belongsTo('maze\User');
    }

    public function editor()
    {
        return $this->belongsTo('maze\User', 'edited_by', 'id');
    }

    public function notifications()
    {
        return $this->morphMany('Notification', 'object');
    }

    public function mentions()
    {
        return $this->morphMany('Mention', 'object');
    }

    public function latestComments()
    {
        return $this->comments()->orderBy('created_at', 'ASC')->take(5)->get();
    }

    public function scopeFollowing($query)
    {
        $users = Auth::user()->follower_list;
        return $query->whereIn('user_id', $users);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopePaged($query)
    {
        return $query->paginate(10);
    }

    public function getExcerptAttribute()
    {
        $excerpt = str_limit($this->body_original, 200, '...');
        $excerpt = Markdown::convertToHtml($excerpt);
    }

    public function getBodyOriginalAttribute($value)
    {
        if ($value) {
            return $value;
        } else {
            return $this->body;
        }
    }

    public function getUrlAttribute()
    {
        return route('status.show', $this->id);
    }

    public function getNotificationAttribute()
    {
        return $this->body;
    }

    public function getActivityAttribute()
    {
        return $this->body;
    }

    public static function getSidebarStatuses()
    {
        return Cache::remember('sidebar_statuses', 1, function () {
            return self::orderBy('created_at', 'DESC')->with('comments')->take(5)->get();
        });
    }
}
