<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    const NAMES = [
        'Dog',
        'Cat',
        'Raccoon',
        'Penguin'
    ];
    protected $fillable = [
        'title', 'content', 'author', 'parent',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
