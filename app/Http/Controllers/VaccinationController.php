<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use App\Helpers\VaccineHelper; 

class VaccinationController extends Controller
{
    public function scheduleVaccinations()
    {
        $unscheduledUsers = User::where('status', 'Not scheduled')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($unscheduledUsers as $user) {
            $center = VaccineCenter::find($user->vaccine_center_id);

         
            $nextAvailableDate = VaccineHelper::getNextAvailableDate($center->id);

            $user->update([
                'scheduled_date' => $nextAvailableDate,
                'status' => 'Scheduled'
            ]);
        }

        return response()->json(['message' => 'Vaccination scheduling complete']);
    }
}
