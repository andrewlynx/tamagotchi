<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Pet;

class PetPropertyUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $pets;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $pets)
    {
        foreach ($pets as $pet) {
            $data['petCare'] = $pet->petCare->value;
            $data['petHunger'] = $pet->petHunger->value;
            $data['petSleeping'] = $pet->petSleeping->value;
            $this->pets[$pet->id] = $data;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('pet');
    }
    
    public function broadcastAs() {
        return 'property';
    }
}
