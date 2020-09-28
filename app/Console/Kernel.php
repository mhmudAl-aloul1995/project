<?php

namespace App\Console;

use App\Console\Commands\CreatProductShopify;
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
        Commands\CreatProductShopify::class,
        Commands\GetProductShopify::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('product:create')
            ->everyMinute()
            ->appendOutputTo(storage_path('logs/postProduct.log'));


        $schedule->command('product:get')
            ->everyMinute()
            ->appendOutputTo(storage_path('logs/getProduct.log'));

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
