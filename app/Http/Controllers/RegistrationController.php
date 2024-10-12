<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\VaccineHelper;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        $centers = VaccineCenter::all();
        return view('registration', compact('centers'));
    }

    public function register(Request $request)
    {
        $existingUser = User::where('nid', $request->nid)
            ->orWhere('email', $request->email)
            ->first();

        if ($existingUser) {
            return redirect()->back()->withErrors(['error' => 'User with this NID or email is already registered.']);
        }

        // Get the next available date for vaccination using the helper function
        $nextAvailableDate = VaccineHelper::getNextAvailableDate($request->vaccine_center_id);

        $user = User::create([
            'nid' => $request->nid,
            'name' => $request->name,
            'email' => $request->email,
            'vaccine_center_id' => $request->vaccine_center_id, 
            'password' => Hash::make($request->password), // Hash the password
            'scheduled_date' => $nextAvailableDate,
            'status' => 'Not scheduled',
        ]);

        return redirect()->route('search')->with('success', 'Registration successful!');
    }
}
