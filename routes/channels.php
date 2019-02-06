<?php

use App\Broadcasting\PetChannel;
use App\Pet;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('pet.{petId}', function ($user, $petId) {
    return $user->id === Pet::find($petId)->user_id;
}); 

Broadcast::channel('pet.{petId}', PetChannel::class);