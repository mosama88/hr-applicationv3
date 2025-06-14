<?php

namespace App\Enums\Employee;

enum MotivationType: int
{
    case None = 1;
    case Changeable = 2;
    case Fixed = 3;



    public function label(): string
    {
        return match ($this) {
            self::None => 'لا يوجد',
            self::Changeable => 'متغير',
            self::Fixed => 'ثابت',
        };
    }
}
