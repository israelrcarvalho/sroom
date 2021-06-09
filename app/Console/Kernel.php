<?php

namespace IrcScheduledRoom\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \IrcScheduledRoom\Console\Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            DB::update('update evento_periodo  set STATUS = 4 where DATE(dt_realizacao) < CURDATE() AND STATUS = ?',['5']);
        })->daily();
    }
}
