<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\BackupDatabase; // 

class Kernel extends ConsoleKernel
{
    protected $commands = [
        BackupDatabase::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Backup automático cada 3 horas
        $schedule->command('backup:database')
                ->everyThreeHours()
                ->appendOutputTo(storage_path('logs/backup.log'));

        // También hacer backup diario a las 2:00 AM
        $schedule->command('backup:database')
                ->dailyAt('02:00')
                ->appendOutputTo(storage_path('logs/backup.log'));
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
