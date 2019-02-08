<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PetProperty extends Model
{
    protected $fillable = [
        'value',
    ];

    /**
     * Max property value
     * @var type
     */
    protected $max = 100;

    /**
     * Default decreasing value
     * @var type
     */
    protected $decreaseValue = 1;

    /**
     * defines relations with model Pet
     * 
     * @return \App\PetProperty
     */
    public function pet()
    {
        return $this->belongsTo('App\Pet');
    }

    /**
     * Set property to its max value
     * 
     * @return \App\PetProperty
     */
    public function increase()
    {
        return $this->update(['value' => $this->max]);
    }

    /**
     * Calculate decreasing interval with special conditions
     * 
     * @return int
     */
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

    /**
     * Decrease value if it meets interval requirements
     * 
     * @return bool
     */
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
