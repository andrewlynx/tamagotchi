<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetHunger extends PetProperty
{
    protected $table = 'pets_hunger';
    protected $interval = 3; // 10
}
