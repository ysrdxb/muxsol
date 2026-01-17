<?php

namespace App\Enums;

enum ContactStatus: string
{
    case NEW = 'new';
    case CONTACTED = 'contacted';
    case QUALIFIED = 'qualified';
    case CONVERTED = 'converted';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::CONTACTED => 'Contacted',
            self::QUALIFIED => 'Qualified',
            self::CONVERTED => 'Converted',
            self::CLOSED => 'Closed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::NEW => 'blue',
            self::CONTACTED => 'yellow',
            self::QUALIFIED => 'purple',
            self::CONVERTED => 'green',
            self::CLOSED => 'gray',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($status) => [
            $status->value => $status->label()
        ])->toArray();
    }
}
