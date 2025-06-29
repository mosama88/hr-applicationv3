<?php

namespace App\Enums\Salaries;

enum IsAutoSalaryEnum: int
{
    case Auto = 1;
    case Manual = 2;

    public function label(): string
    {
        return match ($this) {
            self::Auto => 'آلي',
            self::Manual => 'يدوي',
        };
    }
}