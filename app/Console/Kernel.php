<?php

namespace Radiophonix\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Radiophonix\Console\Commands\AlphaRefresh;
use Radiophonix\Console\Commands\AlphaSeed;
use Radiophonix\Console\Commands\PublishTracks;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        PublishTracks::class,
        AlphaSeed::class,
        AlphaRefresh::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->daily()->at('02:00');

        // $schedule->command('radiophonix:publish')->hourly();
    }
}
