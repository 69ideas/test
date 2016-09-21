<?php

namespace App\Console;

use App\Console\Commands\CheckPayStatus;
use App\Console\Commands\Refund;
use App\Console\Commands\SendReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
        CheckPayStatus::class,
        Refund::class,
        SendReminder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('paypal')
                  ->everyMinute();

         $schedule->command('paypal:refund')
                  ->everyMinute();
        $schedule->command('paypal:fees')
            ->weekly();
    }
}
