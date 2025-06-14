<?php

namespace App\Enums\Employee;

enum FunctionalStatus: int
{
    case Employee = 1;
    case Unemployed = 2;


    public function label(): string
    {
        return match ($this) {
            self::Employee => 'موظف',
            self::Unemployed => 'لا يعمل',
        };
    }
}