<?php

namespace App\Enums\Employee;

enum SocialStatus: int
{
    case Single = 1;
    case Married = 2;
    case Divorced = 3;
    case Widowed = 4;



    public function label(): string
    {
        return match ($this) {
            self::Single => 'أعزب',
            self::Married => 'متزوج / متزوجة',
            self::Divorced => 'مطلق / مطلقه',
            self::Widowed => 'أرمل / أرملة',
        };
    }
}
