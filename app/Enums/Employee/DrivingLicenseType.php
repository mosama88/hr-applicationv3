<?php

namespace App\Enums\Employee;

enum DrivingLicenseType: int
{
    case Other = 1;
    case Special = 2;
    case First = 3;
    case Second = 4;
    case Third = 5;
    case Fourth = 6;
    case Pro = 7;
    case Motorcycle = 8;



    public function label(): string
    {
        return match ($this) {
            self::Special => 'رخصه خاصه',
            self::First => 'درجه أولى',
            self::Second => 'درجه ثانية',
            self::Third => 'درجه ثالثه',
            self::Fourth => 'درجه رابعه',
            self::Pro => 'مهنى',
            self::Motorcycle => 'دراجه نارية',
            self::Other => 'آخرى',
        };
    }
}