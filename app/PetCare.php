<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetCare extends PetProperty
{
    protected $table = 'pets_care';

    /**
     * Define interval to decrease property in minutes
     * 
     * @var type 
     */
    protected $interval = 15;
}
