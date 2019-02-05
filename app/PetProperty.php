<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetProperty extends Model
{
    protected $fillable = [
        'value',
    ];

    public function pet()
    {
        return $this->belongsTo('App\Pet');
    }
}
