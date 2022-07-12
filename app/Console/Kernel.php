<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Order;
use DB;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        'App\Console\Commands\CancelOrderCommand',
        'App\Console\Commands\RemindEmptyProducts',
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('auth:clear-resets')->everyFifteenMinutes();
        $schedule->command('cancel:order')->everyTwoMinutes()->withoutOverlapping();
        $schedule->command('notify:no-stock-product')->twiceDaily(8, 13);
        
        /*$schedule->call(function () {
            Order::where('status', 'pending')
            ->where('created_at', '<=', now()->subMinutes(30)->toDateTimeString())
            ->get();
        })->everyFiveMinutes();*/
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
