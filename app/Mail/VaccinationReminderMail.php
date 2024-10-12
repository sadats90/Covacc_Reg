<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VaccinationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Vaccination Reminder')
            ->view('emails.vaccination_reminder')
            ->with([
                'name' => $this->user->name,
                'scheduled_date' => $this->user->scheduled_date
            ]);
    }
}
