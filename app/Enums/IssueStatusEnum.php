<?php

namespace App\Enums;

enum DoctorAppointmentStatus: int
{

    case INITIATED = 1;
    case PROGRESS = 2;
    case COMPLETED = 3;
    
    /**
     * Get a human-readable label for each status.
     */
    public function label(): string
    {
        return match ($this) {
            self::INITIATED => 'Initiated',
            self::PROGRESS => 'In-progress',
            self::COMPLETED => 'Completed',
        };
    }
}
