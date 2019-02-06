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
    protected $decreaseValue = 1;

    public function pet()
    {
        return $this->belongsTo('App\Pet');
    }

    protected function increase()
    {
        return $this->update(['value', $this->max]);
    }

    public function decrease()
    {
        if ($this->updated_at <= Carbon::now()->subMinutes($this->interval)->toDateTimeString()) {
            $this->value -= $this->decreaseValue;
            $this->save();
        }
        return $this;
    }
}
