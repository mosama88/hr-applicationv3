<?php

namespace App\Enums;

enum IsArchivedEnum: int
{
    case Yes = 1;
    case No = 2;

    public function label(): string
    {
        return match ($this) {
            self::Yes => 'نعم',
            self::No => 'لا',
        };
    }
}
