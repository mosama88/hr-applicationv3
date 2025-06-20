<?php

namespace App\Enums;

enum FinanceCalendarsIsOpen: int
{
    case Pending = 1;
    case Open = 2;
    case Archived = 3;

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'معلق',
            self::Open => 'مفتوح',
            self::Archived => 'مؤرشف',
        };
    }
}
