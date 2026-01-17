<?php

namespace App\Enums;

enum MenuLocation: string
{
    case HEADER = 'header';
    case FOOTER = 'footer';
    case SIDEBAR = 'sidebar';
    case MOBILE = 'mobile';

    public function label(): string
    {
        return match ($this) {
            self::HEADER => 'Header Navigation',
            self::FOOTER => 'Footer Navigation',
            self::SIDEBAR => 'Sidebar Navigation',
            self::MOBILE => 'Mobile Navigation',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($location) => [
            $location->value => $location->label()
        ])->toArray();
    }
}
