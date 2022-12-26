<?php

namespace App\Events;

use App\Models\User;
use App\Models\Model;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContentCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct() {}
	
	/**
	 * Get the data to broadcast.
	 *
	 * @return array
	 */
	public function broadcastWith(): array
	{
		return ['message' => 'Content Added'];
	}
	
	/**
	public function broadcastAs(): string
	{
		return 'content.created';
	}
    */
	
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('content.created');
    }
}
