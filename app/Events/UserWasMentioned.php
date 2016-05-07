<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use maze\User;
use maze\Mentions\Mention;

class UserWasMentioned extends Event
{
    use SerializesModels;

    public $notifiable;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($location, User $user)
    {
        $this->user = $user;

        //sukuriam paminejima duomenu bazeje.
        $mention = \maze\Mention::create([
            'user_id'       => $user->id,
            'object_type'   => class_basename($location),
            'object_id'     => $location->id,
        ]);

        $this->notifiable = $mention;
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
