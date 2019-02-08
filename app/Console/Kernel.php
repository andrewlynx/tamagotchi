<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Events\PetPropertyUpdate;
use App\Pet;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Decrease pet properties if they meet requirements.
        // If any of prorerties is changed, trigger Pusher event
        $schedule->call(function () {
            $processed = [];
            Pet::all()->each( function ($pet, $key) use (&$processed) {
                if ($pet->decreaseProps()) {
                    $processed[] = $pet;
                }
            });
            if (!empty($processed)) {
                event(new PetPropertyUpdate($processed));
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
