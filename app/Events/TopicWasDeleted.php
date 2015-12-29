<?php

namespace maze\Events;

use maze\Events\Event;
use maze\Topic;
use maze\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TopicWasDeleted extends Event
{
    use SerializesModels;

    public $user;
    public $topic;
    public $weight;
    public $karma;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Topic $topic, User $user)
    {
        $this->topic = $topic;
        $this->user = $user;
        $this->weight = 0;
        $this->karma = $topic->vote_count;
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
