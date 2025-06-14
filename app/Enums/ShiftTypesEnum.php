<?php

namespace App\Enums;

enum ShiftTypesEnum: int
{
    case MORNING = 1;
    case NIGHT = 2;
    case FULLTIME = 3;


    public function label(): string
    {
        return match ($this) {
            self::MORNING => 'صباحى',
            self::NIGHT => 'مسائى',
            self::FULLTIME => 'يوم كامل',
        };
    }
}