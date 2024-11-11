<?php

namespace App\Enums;

enum AppointmentStatusEnum: int
{
    const PENDING = 1;
    const CONFIRMED = 2;
    const CANCELLED = 3;
    const COMPLETED = 4;
    
    public static function label(int $value): ?string
    {
        return static::map()[$value] ?? null;
    }

    public static function map() : array
    {
        return [
            static::PENDING => 'Pending',
            static::CONFIRMED => 'Confirmed',
            static::CANCELLED => 'Cancelled',
            static::COMPLETED => 'Completed',
        ];
    }
}
