<?php

namespace App\Console\Commands;

use App\Enums\AppointmentStatusEnum;
use App\Jobs\SendAppointmentReminderMailJob;
use App\Models\DoctorAppointment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MedicalReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genie:medical-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genie Reminder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appointments = DoctorAppointment::with(['user','user_problem'])
        // ->where('appointment_date', '>', now() )
        // ->whereIn('status', [AppointmentStatusEnum::CONFIRMED])
        ->get();
        $this->info('Appointments coming up: ' . $appointments->count());

        foreach ($appointments as $data) {
            $content = [
                "toMail" => $data->user->email ?? "",
                "name" => $data->user->name ?? "",
                "date" => $data->appointment_date ?? "",
                "time" => $data->appointment_time ?? "",
                "issue" => $data->user_problem->problem->title ?? "N/A",
                "details" => $data->user_problem->details ?? "N/A",
            ];
            $emailAppointmentReminderJob = new SendAppointmentReminderMailJob($content);
            dispatch($emailAppointmentReminderJob->delay(Carbon::now()->addSeconds(5)));
        }

    }
}
