<?php

namespace App\Enums;

enum IsArchivedEnum: int
{
    case Archived = 1;
    case Unarchived = 2;

    public function label(): string
    {
        return match ($this) {
            self::Archived => 'مؤرشف',
            self::Unarchived => 'غير مؤرشف',
        };
    }
}