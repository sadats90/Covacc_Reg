<?php

namespace App\Providers;
use App\Jobs\SendVaccinationReminderJob;
use Illuminate\Support\ServiceProvider;



use Illuminate\Console\Scheduling\Schedule;

class ScheduleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Schedule $schedule): void
    {
        $schedule->job(new SendVaccinationReminderJob)->dailyAt('21:00');
    }
}
