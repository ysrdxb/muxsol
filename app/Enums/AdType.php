<?php

namespace App\Enums;

enum AdType: string
{
    case IMAGE = 'image';
    case HTML = 'html';
    case SCRIPT = 'script';

    public function label(): string
    {
        return match ($this) {
            self::IMAGE => 'Image Banner',
            self::HTML => 'HTML Content',
            self::SCRIPT => 'Script/Code',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($type) => [
            $type->value => $type->label()
        ])->toArray();
    }
}
