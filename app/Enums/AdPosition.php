<?php

namespace App\Enums;

enum AdPosition: string
{
    case HEADER_TOP = 'header_top';
    case HEADER_BOTTOM = 'header_bottom';
    case SIDEBAR_TOP = 'sidebar_top';
    case SIDEBAR_BOTTOM = 'sidebar_bottom';
    case CONTENT_TOP = 'content_top';
    case CONTENT_BOTTOM = 'content_bottom';
    case FOOTER = 'footer';
    case POPUP = 'popup';
    case STICKY_BOTTOM = 'sticky_bottom';

    public function label(): string
    {
        return match ($this) {
            self::HEADER_TOP => 'Header Top',
            self::HEADER_BOTTOM => 'Header Bottom',
            self::SIDEBAR_TOP => 'Sidebar Top',
            self::SIDEBAR_BOTTOM => 'Sidebar Bottom',
            self::CONTENT_TOP => 'Content Top',
            self::CONTENT_BOTTOM => 'Content Bottom',
            self::FOOTER => 'Footer',
            self::POPUP => 'Popup',
            self::STICKY_BOTTOM => 'Sticky Bottom Bar',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($position) => [
            $position->value => $position->label()
        ])->toArray();
    }
}
