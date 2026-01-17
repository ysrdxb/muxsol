<?php

namespace App\Enums;

enum EmailTemplateType: string
{
    case TRANSACTIONAL = 'transactional';
    case MARKETING = 'marketing';
    case NOTIFICATION = 'notification';

    public function label(): string
    {
        return match ($this) {
            self::TRANSACTIONAL => 'Transactional',
            self::MARKETING => 'Marketing',
            self::NOTIFICATION => 'Notification',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($type) => [
            $type->value => $type->label()
        ])->toArray();
    }
}
