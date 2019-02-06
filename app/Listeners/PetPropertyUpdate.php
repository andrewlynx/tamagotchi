<?php

namespace App\Listeners;

use App\Events\PetPropertyUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PetPropertyUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PetPropertyUpdate  $event
     * @return void
     */
    public function handle(PetPropertyUpdate $event)
    {
        //
    }
}
