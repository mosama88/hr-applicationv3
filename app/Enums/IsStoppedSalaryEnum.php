<?php

namespace App\Enums;

enum IsStoppedSalaryEnum: int
{
    case Unstopped = 1;
    case Stopped = 2;

    public function label(): string
    {
        return match ($this) {
            self::Unstopped => 'سارى',
            self::Stopped => 'موقوف',
        };
    }
}