<?php

namespace maze\Events;

use maze\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use maze\Channel;
use maze\Donation;

class DonationWasMade extends Event
{
    use SerializesModels;

    private $channel;
    private $amount;
    private $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Channel $channel, Donation $donation)
    {
        $this->channel      = $channel;
        $this->donation     = $donation;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['paysera-channel'];
    }

    public function broadcastWith()
    {
        return [
            'channel'   => $this->channel->secret,
            'data'      => $this->donation->toArray()
        ];
    }
}
