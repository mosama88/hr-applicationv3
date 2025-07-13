<?php

namespace App\Enums\PermanentLoan;

enum PermanentLoanStatusEnum: int
{
    case Pending = 1;
    case PaidSalary = 2;
    case PaidCash = 3;

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'معلق',
            self::PaidSalary => 'تم الدفع على المرتب',
            self::PaidCash => 'تم الدفع كاش',
        };
    }
}


 //حالة الدفع: صفر معلق - واحد تم الدفع على المرتب - أثنين تم الدفع كاش