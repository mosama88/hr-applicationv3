<?php

namespace App\Enums\Employee;

enum ReligionEnum: int
{
    case Muslim = 1;
    case Christian = 2;




    public function label(): string
    {
        return match ($this) {
            self::Muslim => 'مسلم',
            self::Christian => 'مسيحى',
        };
    }
}
