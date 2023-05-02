<?php

namespace App\Console;

use App\Source\Commands\Firebase\RemoveUsersFromFirebaseCommand;
use App\Source\Commands\Messaging\DeleteOldMessagesCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(RemoveUsersFromFirebaseCommand::class)->twiceDaily();
        $schedule->command(DeleteOldMessagesCommand::class)->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        $this->load(__DIR__ . '/../Source/Commands');

        require base_path('routes/console.php');
    }
}
