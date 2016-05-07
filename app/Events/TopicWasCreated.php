<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use maze\Events\NewsWasPosted;
use maze\User;
use maze\Topic;

class TopicWasCreated extends Event
{
    use SerializesModels;

    public $topic;
    public $user;
    public $notifiable;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Topic $topic, User $user)
    {
        $this->topic = $topic;
        $this->user = $user;
        $this->notifiable = $topic;

        //patikrinam ar tema yra naujiena.
        if ($topic->node_id == 15) {
            event(new NewsWasPosted($topic));
        }

        $user->increment('topic_count');
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notifications'];
    }
}
