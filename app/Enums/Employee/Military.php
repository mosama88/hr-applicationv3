<?php

namespace App\Enums\Employee;

enum Military: int
{
    case ExemptionTemporary = 1;
    case FinalExemption = 2;
    case Complete = 3;
    case None = 4;



    public function label(): string
    {
        return match ($this) {
            self::ExemptionTemporary => 'إعفاء مؤقت',
            self::FinalExemption => 'إعفاء نهائى',
            self::Complete => 'أدى الخدمه',
            self::None => 'ليس لدية',
        };
    }
}
