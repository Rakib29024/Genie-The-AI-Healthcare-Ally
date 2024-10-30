<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
    protected $fillable = [
        'user_problem_id',  // Foreign key to UserProblem
        'user_id',          // Foreign key to User
        'problem_id',       // Foreign key to Problem
        'details',          // Details about the appointment
        'appointment_date', // Date of the appointment
        'appointment_time', // Time of the appointment
        'status',           // Status of the appointment
    ];
}
