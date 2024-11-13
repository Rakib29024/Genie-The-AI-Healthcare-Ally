<?php

namespace App\Jobs;

use App\Mail\SendAppointmentReminderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendAppointmentReminderMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $details;
    
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->details['toMail'])->send(new SendAppointmentReminderMail($this->details));
    }
}
