<?php

namespace App\Enums;

enum BackupType: string
{
    case FULL = 'full';
    case DATABASE = 'database';
    case FILES = 'files';

    public function label(): string
    {
        return match ($this) {
            self::FULL => 'Full Backup',
            self::DATABASE => 'Database Only',
            self::FILES => 'Files Only',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($type) => [
            $type->value => $type->label()
        ])->toArray();
    }
}
