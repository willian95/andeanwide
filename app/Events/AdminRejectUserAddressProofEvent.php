<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AdminRejectUserAddressProofEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $reasons;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $reasons)
    {
        $this->user = $user;
        $this->reasons = $reasons;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
