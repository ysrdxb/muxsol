<?php

namespace App\Enums;

enum FunnelStepType: string
{
    case LANDING = 'landing';
    case OPT_IN = 'opt_in';
    case SALES = 'sales';
    case CHECKOUT = 'checkout';
    case THANK_YOU = 'thank_you';
    case UPSELL = 'upsell';
    case DOWNSELL = 'downsell';
    case WEBINAR = 'webinar';

    public function label(): string
    {
        return match ($this) {
            self::LANDING => 'Landing Page',
            self::OPT_IN => 'Opt-in Page',
            self::SALES => 'Sales Page',
            self::CHECKOUT => 'Checkout Page',
            self::THANK_YOU => 'Thank You Page',
            self::UPSELL => 'Upsell Page',
            self::DOWNSELL => 'Downsell Page',
            self::WEBINAR => 'Webinar Page',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::LANDING => 'home',
            self::OPT_IN => 'user-plus',
            self::SALES => 'shopping-cart',
            self::CHECKOUT => 'credit-card',
            self::THANK_YOU => 'check-circle',
            self::UPSELL => 'arrow-trending-up',
            self::DOWNSELL => 'arrow-trending-down',
            self::WEBINAR => 'video-camera',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($type) => [
            $type->value => $type->label()
        ])->toArray();
    }
}
