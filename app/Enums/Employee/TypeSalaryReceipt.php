<?php

namespace App\Enums\Employee;

enum TypeSalaryReceipt: int
{
    case Visa = 1;
    case Cash = 2;




    public function label(): string
    {
        return match ($this) {
            self::Visa => 'فيزا',
            self::Cash => 'كاش',
        };
    }
}
