<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use maze\User;
use maze\Notification;

class UserWasNotified extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $object;
    public $user;
    public $notification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($object, User $user, Notification $notification)
    {
        $this->object = $object;
        $this->user = $user;
        $this->notification = $notification;
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

    public function broadcastWith()
    {
        $from = $this->notification->fromUser;

        return [
            'user' => [
                'secret' => $this->user->secret,
            ],
            'notification' => [
                'fromUser' => [
                    'username' => $from->username,
                    'avatar' => $from->avatar,
                    'url' => $from->url,
                ],
                'body' => $this->notification->object->notification,
            ],
        ];
    }
}
