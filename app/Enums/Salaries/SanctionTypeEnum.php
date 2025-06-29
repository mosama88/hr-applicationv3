<?php

namespace App\Enums\Salaries;

enum SanctionTypeEnum: int
{
    case DaysSanction = 1;
    case FingerprintSanction = 2;
    case InvestigationSanction = 3;

    public function label(): string
    {
        return match ($this) {
            self::DaysSanction => 'جزاء أيام',
            self::FingerprintSanction => 'جزاء بصمة',
            self::InvestigationSanction => 'جزاء تحقيق',
        };
    }
}