<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetSleeping extends PetProperty
{
    protected $table = 'pets_sleeping';

    /**
     * Define interval to decrease property in minutes
     * 
     * @var type 
     */
    protected $interval = 20;
}
