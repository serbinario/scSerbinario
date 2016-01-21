<?php

namespace SCSerbinario\Console;

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
        \SCSerbinario\Console\Commands\Inspire::class,
        \SCSerbinario\Console\Commands\StartConfig::class,
        \SCSerbinario\Console\Commands\ModelConfig::class,
        \SCSerbinario\Console\Commands\RequestConfig::class,
        \SCSerbinario\Console\Commands\ConvertMigrations::class,
        \SCSerbinario\Console\Commands\Symfony\CrudBasicoSymfony::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();
    }
}
