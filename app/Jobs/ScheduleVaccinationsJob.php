<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\User;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ScheduleVaccinationsJob implements ShouldQueue
{
    use Dispatchable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Scheduling vaccinations job started.');

    // Preload all vaccine centers into a collection for efficiency
    $centers = VaccineCenter::all()->keyBy('id');
    Log::info('Loaded vaccine centers: ', $centers->toArray());

    // Fetch all users with status 'Not scheduled'
    $users = User::where('status', 'Not scheduled')
        ->orderBy('created_at', 'asc')
        ->get();

    Log::info('Fetched users: ', $users->toArray());

    foreach ($users as $user) {
        // Get the center from the preloaded collection
        $center = $centers->get($user->vaccine_center_id);
        if ($center) {
            $nextAvailableDate = $this->getNextAvailableDate($center->id);
            Log::info("Scheduling user {$user->id} for date {$nextAvailableDate}");

            // Update the user's status and schedule their vaccination
            $user->update([
                'scheduled_date' => $nextAvailableDate,
                'status' => 'Scheduled'
            ]);
            Log::info("User {$user->id} scheduled successfully.");
        } else {
            Log::warning("No center found for user {$user->id}");
        }
    }
    }

    /**
     * Calculate the next available vaccination date for the given center.
     */
    private function getNextAvailableDate($centerId)
    {
        $center = VaccineCenter::find($centerId);
        $date = Carbon::now();  // Start from today

        // Preload already scheduled users at this center
        $scheduledUsers = User::where('vaccine_center_id', $centerId)
            ->where('scheduled_date', '>=', $date->toDateString())
            ->get()
            ->groupBy('scheduled_date');

        // Loop through each day until an available date is found
        while (true) {
            // Check if there are users scheduled on the current date
            $scheduledCount = isset($scheduledUsers[$date->toDateString()])
                ? $scheduledUsers[$date->toDateString()]->count()
                : 0;

            // If the center's daily capacity is not exceeded, return the date
            if ($scheduledCount < $center->daily_capacity) {
                return $date->toDateString();
            }

            // Otherwise, move to the next day
            $date->addDay();
        }
    }
}
