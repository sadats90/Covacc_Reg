<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\VaccineCenter;
use Carbon\Carbon;

class VaccineHelper
{
    /**
     * Get the next available vaccination date for a specific vaccine center.
     * 
     * @param int $centerId
     * @return string (Date)
     */
    public static function getNextAvailableDate($centerId)
    {
        $center = VaccineCenter::find($centerId);

        // Start from 7 days ahead
        $date = Carbon::now()->addDays(7);

        while (true) {
            // Skip Friday (5) and Saturday (6)
            if ($date->dayOfWeek == 5 || $date->dayOfWeek == 6) {
                $date->addDay();
                continue;
            }

            // Count scheduled users for the selected date
            $scheduledCount = User::where('vaccine_center_id', $centerId)
                ->where('scheduled_date', $date->toDateString())
                ->count();

            // If the scheduled count is less than the center's daily limit, return the date
            if ($scheduledCount < $center->daily_limit) {
                return $date->toDateString();
            }

            // Move to the next day if capacity is reached
            $date->addDay();
        }
    }
}
