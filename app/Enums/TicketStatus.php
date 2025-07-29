<?php

namespace App\Enums;

enum TicketStatus: int
{
    case Pending = 0;
    case InProgress = 1;
    case Closed = 2;

    function label(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::InProgress => 'In Progress',
            self::Closed => 'Closed',
        };
    }
}
