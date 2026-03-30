<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */


    protected function schedule(Schedule $schedule)
    {

        // $schedule->command('inspire')->hourly();
        // $schedule->command('IntituteSuspenstion:cron')
        //     ->everyMinute()->appendOutputTo('storage/logs/output.log');
        // $schedule->command('InstituteAboutToExpire:cron')
        //     ->dailyAt('00:01')->appendOutputTo('storage/logs/output.log');  //template14

        // $schedule->command('InstituteExpired:cron')
        //     ->dailyAt('00:01')->appendOutputTo('storage/logs/output.log');
        // $schedule->command('InstitutePostExpire:cron')
        //     ->dailyAt('00:01')->appendOutputTo('storage/logs/output.log');
        // $schedule->command('IntituteSuspenstion:cron')
        //     ->dailyAt('00:01');

        $schedule->command('IntituteBulkCreate:cron')
            ->everyFiveMinutes()->appendOutputTo('storage/logs/output.log');

        $schedule->command('retrievepaymentstatus:cron')
            ->everyFiveMinutes()->appendOutputTo('storagegit pull
            /logs/lead.log');

        $schedule->command('Contact:Lead')
            ->everyFiveMinutes()->appendOutputTo('storage/logs/lead.log');
        $schedule->command('Enroll:Lead')
            ->everyFiveMinutes()->appendOutputTo('storage/logs/lead.log');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
