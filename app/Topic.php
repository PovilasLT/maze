<?php namespace maze;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Config;
use Stringy\StaticStringy as S;

class Topic extends Model
{

    protected $morphClass = 'Topic';

    protected $appends = [
        'node',
    ];

    protected $fillable = [
        'node_id',
        'title',
        'body',
        'body_original',
        'user_id',
        'type_id',
    ];

    use SoftDeletes;

    public $view = 'topic.item';

    public function replies()
    {
        return $this->hasMany('maze\Reply');
    }

    public function user()
    {
        return $this->belongsTo('maze\User');
    }

    public function node()
    {
        return $this->belongsTo('maze\Node');
    }

    public function poll()
    {
        return $this->hasOne('maze\Poll');
    }

    public function type()
    {
        return $this->hasOne('maze\TopicType', 'id', 'type_id');
    }

    public function notifications()
    {
        return $this->morphMany('Notification', 'object');
    }

    public function mentions()
    {
        return $this->morphMany('Mention', 'object');
    }

    public function votes()
    {
        return $this->morphMany('Vote', 'votable');
    }

    //wtf does this do?
    public function scopeUser($query, $user)
    {
        if (!$user) {
            return $query;
        }
        return $query->whereNested(function ($query) use ($user) {
            $query->where('user_id', '=', $user->id)->orWhereExists(function ($query) use ($user) {
                $query->select('id')->from('replies')->where('replies.user_id', '=', $user->id)->whereRaw('topics.id = replies.topic_id');
            });
        });
    }

    public function scopePopular($query)
    {
        return $query->orderBy('weight', 'DESC')->latest();
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }

    public function scopeLatestPost($query)
    {
        return $query->orderByRaw('(select created_at from replies where topic_id = topics.id order by created_at desc limit 1) desc');
    }

    public function scopeGames($query)
    {
        $user = Auth::user();

        if ($user) {
            return $query->whereIn('node_id', $user->frontPageNodes());
        } else {
            return $query->whereIn('node_id', Node::frontPageNodes());
        }
    }

    public function scopePinnedLocal($query)
    {
        return $query->orderBy('pin_local', 'DESC');
    }

    public function scopePinned($query)
    {
        return $query->orderBy('order', 'DESC');
    }

    public function scopeWithReplies($query)
    {
        return $query->with(['replies' => function ($replies_query) {
            return $replies_query->orderBy('created_at', 'DESC');
        }, 'replies.user']);
    }

    //Pagrindinio puslapio topicai

    public static function scopeFrontPage($query, $sort)
    {
        if ($sort == 'populiariausi' || !$sort) {
            return $query->games()->pinned()->popular()->withReplies();
        } elseif ($sort == 'mano-turinys') {
            return $query->games()->pinned()->user(Auth::user())->latestPost()->withReplies();
        } elseif ($sort == 'naujausi-pranesimai') {
            return $query->games()->pinned()->latestPost()->withReplies();
        } else {
            return $query->games()->pinned()->latest()->withReplies();
        }
    }

    public function scopeWithVotes($query)
    {
        return $query->with(['votes']);
    }

    // Sidebar skelbimai
    public static function scopeMarket($query)
    {
        return $query->whereIn('node_id', Node::marketNodes())->orderBy('id', 'desc')->limit(config('app.advertisements'));
    }

    public function sameNodeTopics()
    {
        $topics = Topic::where('node_id', $this->node_id)->where('id', '<>', $this->id)->take('10')->get();
        return $topics;
    }

    public function getSlugAttribute($value)
    {
        if (! $value) {
            $value = $this->id . '-' . S::slugify($this->title);

            $nodes = Topic::where('slug', $value);

            if ($nodes->count() > 0) {
                $value = $this->id . '-' . $value;
                $this->slug = $value;

                $this->save();

                return $value;
            } else {
                $this->slug = $value;

                $this->save();

                return $value;
            }
        } else {
            return $value;
        }
    }

    public function voted($type, $user = null)
    {
        if ($user || $user = Auth::user()) {
            $vote = $this->votes->where('user_id', $user->id)->first();
            if ($vote && $vote->is == $type.'vote') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function nodePath()
    {
        $parent = $this->node->parent;
        $parent = '<a href="'.route('node.show', $parent->slug).'">'.$parent->name.'</a>';
        $node = $this->node;
        $node = '<a href="'.route('node.show', $node->slug).'">'.$node->name.'</a>';
        return $parent.' &raquo '.$node;
    }


    public function getUrlAttribute()
    {
        return route('topic.show', $this->slug);
    }

    public function getNotificationAttribute()
    {
        return 'Sukūrė temą <a href="' . $this->url . '" alt="' . e($this->title) . '" title="' . e($this->title) . '">' . e($this->title) . '</a>';
    }

    public function getActivityAttribute()
    {
        return 'Sukūrė temą <a href="' . $this->url . '" alt="' . e($this->title) . '" title="' . e($this->title) . '">' . e($this->title) . '</a>';
    }

    /**
     * Veiksmai
     */
    public function lock()
    {    
        $this->is_blocked = 1;
        $this->save();

        return $this;
    }
    public function unlock()
    {
        $this->is_blocked = 0;
        $this->save();

        return $this;
    }
    public function sink()
    {
        $this->order = -1;
        $this->pin_local = -1;
        $this->save();

        return $this;
    }
    public function unsink()
    {
        $this->order = 0;
        $this->pin_local = 0;
        $this->save();

        return $this;
    }
    public function unpin()
    {
        $this->pin_local = 0;
        $this->order = 0;
        $this->save();

        return $this;
    }
    public function pinLocal()
    {
        $this->pin_local = 1;
        $this->save();

        return $this;
    }
    public function pinGlobal()
    {
        $this->order = 1;
        $this->save();

        return $this;
    }

    public function bump()
    {
        $this->weight = $this->weight + 1000;
        $this->touch();
        $this->save();

        return $this;
    }
}
