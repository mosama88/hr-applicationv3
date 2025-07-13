<?php

namespace App\Enums\PermanentLoan;

enum PermanentLoanhasParentDisbursedDoneEnum: int
{
    case Disbursed = 1;
    case Pending = 2;

    public function label(): string
    {
        return match ($this) {
            self::Disbursed => 'تم الصرف',
            self::Pending => 'معلق',
        };
    }
}