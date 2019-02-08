<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pet extends Model
{
    /*
     * list of allowed pet names
     */
    const NAMES = [
        'Dog',
        'Cat',
        'Raccoon',
        'Penguin'
    ];

    protected $fillable = [
        'name',
    ];

    /**
     * defines relations with model User
     * 
     * @return \App\Pet
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * defines relations with model PetCare
     * 
     * @return \App\Pet
     */
    public function petCare()
    {
        return $this->hasOne('App\PetCare');
    }

    /**
     * defines relations with model PetHunger
     * 
     * @return \App\Pet
     */
    public function petHunger()
    {
        return $this->hasOne('App\PetHunger');
    }

    /**
     * defines relations with model PetSleeping
     * 
     * @return \App\Pet
     */
    public function petSleeping()
    {
        return $this->hasOne('App\PetSleeping');
    }

    /**
     * Set default value when creating new Pet
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($pet) {
            $pet->user_id = Auth::id();
        });
    }

    /**
     * Fire decreasing of each property
     * Return true if any of properties have been modified
     * 
     * @return bool
     */
    public function decreaseProps()
    {
        return (
            $this->petCare->decrease() ||
            $this->petHunger->decrease() ||
            $this->petSleeping->decrease()
        );
    }
}
