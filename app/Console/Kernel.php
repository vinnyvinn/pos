<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Log;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

        Commands\SendSalesNotifications::class,
        '\App\Console\Commands\CronJob',
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
       // Log::info("cron job running");
//         $schedule->command('inspire')
//                  ->hourly();
//        $schedule->command('demo:cron')
//            ->everyMinute();
        $schedule->command('CronJob:cronjob')
            ->dailyAt('9:06');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
