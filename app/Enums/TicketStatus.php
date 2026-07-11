<?php

namespace App\Enums;

enum TicketStatus: string
{
    case Open = 'open';
    case InProgress = 'in_progress';
    case Resolved = 'resolved';

    public static function fromValue(int $value): self
    {
        return match ($value) {
            0 => self::Open,
            1 => self::InProgress,
            2 => self::Resolved,
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Open => 'Open',
            self::InProgress => 'In Progress',
            self::Resolved => 'Resolved',
        };
    }
}
