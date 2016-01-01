<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

//models
use maze\Reply;
use maze\Topic;
use maze\User;

use Config;

class ReplyWasCreated extends Event
{
    use SerializesModels;

    public $reply;
    public $topic;
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
        $this->reply = $reply;
        $this->topic = $topic;
        $this->user = $user;
        $this->weight = Config::get('app.reply_gain_weight');
        $this->karma = 0;
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
