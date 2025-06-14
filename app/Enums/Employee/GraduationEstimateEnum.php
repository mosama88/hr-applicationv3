<?php

namespace App\Enums\Employee;

enum GraduationEstimateEnum: int
{
    case Fair = 1;
    case Good = 2;
    case VeryGood = 3;
    case Excellent = 4;



    public function label(): string
    {
        return match ($this) {
            self::Fair => 'مقبول',
            self::Good => 'جيد',
            self::VeryGood => 'جيد جدآ',
            self::Excellent => 'أمتياز',
        };
    }
}