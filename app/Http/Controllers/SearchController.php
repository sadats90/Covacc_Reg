<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $request->validate(['nid' => 'required']);
        
        $user = User::where('nid', $request->nid)->first();

        if (!$user) {
            return view('search')->with('status', 'Not registered');
        }

        if ($user->scheduled_date) {
            $status = Carbon::now()->isAfter($user->scheduled_date) ? 'Vaccinated' : 'Scheduled';
        } else {
            $status = 'Not scheduled';
        }

        return view('search', compact('user', 'status'));
    }
}
