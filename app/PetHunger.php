<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetHunger extends PetProperty
{
    protected $table = 'pets_hunger';

    /**
     * Define interval to decrease property in minutes
     * 
     * @var type 
     */
    protected $interval = 10;
}
