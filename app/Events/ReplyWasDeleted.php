<?php

namespace maze\Events;

use maze\Events\Event;
use maze\Topic;
use maze\Reply;
use maze\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Config;

class ReplyWasDeleted extends Event
{
    use SerializesModels;

    public $topic;
    public $reply;
    public $user;
    public $weight;
    public $karma;
    public $notifiable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Reply $reply, Topic $topic, User $user)
    {
        $this->topic = $topic;
        $this->reply = $reply;
        $this->user = $user;
        $this->weight = Config::get('app.reply_gain_weight');
        $this->karma = $reply->vote;
        $this->notifiable = $reply;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
