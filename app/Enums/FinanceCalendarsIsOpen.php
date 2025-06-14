<?php

namespace App\Enums;

enum FinanceCalendarsIsOpen: int
{
    case Pending = 0;
    case Open = 1;
    case Archived = 2;

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'معلق',
            self::Open => 'مفتوح',
            self::Archived => 'مؤرشف',
        };
    }
}