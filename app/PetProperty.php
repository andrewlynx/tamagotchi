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
    protected $decreaseValue = 5;

    public function pet()
    {
        return $this->belongsTo('App\Pet');
    }

    public function increase()
    {
        return $this->update(['value' => $this->max]);
    }

    public function interval(): int
    {
        $interval = $this->interval;
        if ($this instanceof PetCare) {
            if (PetSleeping::where('pet_id', $this->pet_id)->first()->value < 5) {
                $interval = $interval / 5;
            }
        }
        return $interval;
    }

    public function decrease(): bool
    {
        $decreased = false;
        if ($this->value > 0 &&
            $this->updated_at <= Carbon::now()->subMinutes($this->interval())->toDateTimeString()
        ) {
            $this->value -= $this->decreaseValue;
            $this->save();
            $decreased = true;
        }
        return $decreased;
    }
}
