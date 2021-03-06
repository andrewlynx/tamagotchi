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
            $data['pet_care'] = $pet->petCare->value;
            $data['pet_hunger'] = $pet->petHunger->value;
            $data['pet_sleeping'] = $pet->petSleeping->value;
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
    
    /**
     * Get the channel name.
     *
     * @return string
     */
    public function broadcastAs() {
        return 'property';
    }
}
