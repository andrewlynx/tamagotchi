<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetCare extends PetProperty
{
    protected $table = 'pets_care';
    protected $interval = 15;
}
