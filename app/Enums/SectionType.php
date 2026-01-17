<?php

namespace App\Enums;

enum SectionType: string
{
    case HERO = 'hero';
    case SERVICES = 'services';
    case PORTFOLIO = 'portfolio';
    case TESTIMONIALS = 'testimonials';
    case TEAM = 'team';
    case PRICING = 'pricing';
    case CTA = 'cta';
    case FEATURES = 'features';
    case STATS = 'stats';
    case FAQ = 'faq';
    case CONTACT = 'contact';
    case GALLERY = 'gallery';
    case CLIENTS = 'clients';
    case TEXT_BLOCK = 'text_block';
    case IMAGE_TEXT = 'image_text';
    case VIDEO = 'video';
    case NEWSLETTER = 'newsletter';
    case CUSTOM_HTML = 'custom_html';

    public function label(): string
    {
        return match ($this) {
            self::HERO => 'Hero Section',
            self::SERVICES => 'Services',
            self::PORTFOLIO => 'Portfolio/Projects',
            self::TESTIMONIALS => 'Testimonials',
            self::TEAM => 'Team Members',
            self::PRICING => 'Pricing Tables',
            self::CTA => 'Call to Action',
            self::FEATURES => 'Features',
            self::STATS => 'Statistics/Counters',
            self::FAQ => 'FAQ',
            self::CONTACT => 'Contact Form',
            self::GALLERY => 'Image Gallery',
            self::CLIENTS => 'Clients/Partners',
            self::TEXT_BLOCK => 'Text Block',
            self::IMAGE_TEXT => 'Image with Text',
            self::VIDEO => 'Video Section',
            self::NEWSLETTER => 'Newsletter',
            self::CUSTOM_HTML => 'Custom HTML',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::HERO => 'rectangle-group',
            self::SERVICES => 'squares-2x2',
            self::PORTFOLIO => 'briefcase',
            self::TESTIMONIALS => 'chat-bubble-left-right',
            self::TEAM => 'user-group',
            self::PRICING => 'currency-dollar',
            self::CTA => 'megaphone',
            self::FEATURES => 'star',
            self::STATS => 'chart-bar',
            self::FAQ => 'question-mark-circle',
            self::CONTACT => 'envelope',
            self::GALLERY => 'photo',
            self::CLIENTS => 'building-office',
            self::TEXT_BLOCK => 'document-text',
            self::IMAGE_TEXT => 'rectangle-stack',
            self::VIDEO => 'play-circle',
            self::NEWSLETTER => 'newspaper',
            self::CUSTOM_HTML => 'code-bracket',
        };
    }

    public function view(): string
    {
        return 'frontend.sections.' . str_replace('_', '-', $this->value);
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($type) => [
            $type->value => $type->label()
        ])->toArray();
    }
}
