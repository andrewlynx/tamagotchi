<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pet extends Model
{
    const NAMES = [
        'Dog',
        'Cat',
        'Raccoon',
        'Penguin'
    ];

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function petCare()
    {
        return $this->hasOne('App\PetCare');
    }

    public function petHunger()
    {
        return $this->hasOne('App\PetHunger');
    }

    public function petSleeping()
    {
        return $this->hasOne('App\PetSleeping');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($pet) {
            $pet->user_id = Auth::user()->id;
        });
    }
    
    public function decreaseProps()
    {
        return (
            $this->petCare->decrease() ||
            $this->petHunger->decrease() ||
            $this->petSleeping->decrease()
        );
    }
}
