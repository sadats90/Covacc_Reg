<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendVaccinationReminderJob implements ShouldQueue
{
    public function handle(): void
    {
       
        $tomorrow = Carbon::now()->addDay()->toDateString();
        $users = User::where('scheduled_date', $tomorrow)->get();

        foreach ($users as $user) {
          
            Mail::to($user->email)->send(new \App\Mail\VaccinationReminderMail($user));
        }
    }
}
