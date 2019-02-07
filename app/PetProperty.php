<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PetProperty extends Model
{
    protected $fillable = [
        'value',
    ];

    protected $max = 100;
    protected $decreaseValue = 20;

    public function pet()
    {
        return $this->belongsTo('App\Pet');
    }

    public function increase()
    {
        return $this->update(['value' => $this->max]);
    }

    public function decrease() : bool
    {
        $decreased = false;
        if ($this->updated_at <= Carbon::now()->subMinutes($this->interval)->toDateTimeString()) {
            $this->value -= $this->decreaseValue;
            $this->save();
            $decreased = true;
        }
        return $decreased;
    }
}
