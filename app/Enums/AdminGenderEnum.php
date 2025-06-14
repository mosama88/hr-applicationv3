<?php

namespace App\Enums;

enum AdminGenderEnum: int
{
    case Male = 1;
    case Female = 2;


    public function label(): string
    {
        return match ($this) {
            self::Male => 'ذكر',
            self::Female => 'انثى',
        };
    }
}