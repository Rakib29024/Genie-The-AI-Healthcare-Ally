<?php

namespace App\Models;

use App\Enums\AppointmentStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorAppointment extends Model
{
    protected $fillable = [
        'user_problem_id',  // Foreign key to UserProblem
        'user_id',          // Foreign key to User
        'problem_id',       // Foreign key to Problem
        'details',          // Details about the appointment
        'appointment_date', // Date of the appointment
        'appointment_time', // Time of the appointment
        'status'     // Status of the appointment
    ];

    /**
     * Get the user_problem that owns the DoctorAppointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_problem(): BelongsTo
    {
        return $this->belongsTo(UserProblem::class);
    }

    /**
     * Get the user that owns the DoctorAppointment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
