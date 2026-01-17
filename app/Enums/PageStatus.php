<?php

namespace App\Enums;

enum PageStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case SCHEDULED = 'scheduled';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
            self::SCHEDULED => 'Scheduled',
            self::ARCHIVED => 'Archived',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::DRAFT => 'gray',
            self::PUBLISHED => 'green',
            self::SCHEDULED => 'blue',
            self::ARCHIVED => 'red',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::DRAFT => 'heroicons-o-pencil',
            self::PUBLISHED => 'heroicons-o-check-circle',
            self::SCHEDULED => 'heroicons-o-clock',
            self::ARCHIVED => 'heroicons-o-archive-box',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($status) => [
            $status->value => $status->label()
        ])->toArray();
    }
}
