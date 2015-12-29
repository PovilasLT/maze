<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use maze\Vote;
use maze\User;
use Config;

class DownVoted extends Event
{
    use SerializesModels;

    public $entity;
    public $vote;
    public $user;
    public $weight;
    public $karma;
    public $topic;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($entity, Vote $vote, User $user, $double)
    {
        $this->entity = $entity;
        $this->vote = $vote;
        $this->user = $user;
        $this->weight = Config::get('app.downvote_lose_weight');

        if(class_basename($entity) == 'Topic')
        {
            $this->topic = $entity;
        }

        if($double)
        {
            $this->karma = 1 * 2;
        }
        else
        {
            $this->karma = 1;
        }

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
