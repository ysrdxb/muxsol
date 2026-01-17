<?php

namespace App\Enums;

enum UserRole: string
{
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case VIEWER = 'viewer';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::EDITOR => 'Editor',
            self::VIEWER => 'Viewer',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'red',
            self::ADMIN => 'blue',
            self::EDITOR => 'green',
            self::VIEWER => 'gray',
        };
    }

    public function permissions(): array
    {
        return match ($this) {
            self::SUPER_ADMIN => ['*'],
            self::ADMIN => [
                'dashboard.view',
                'pages.*',
                'sections.*',
                'menus.*',
                'media.*',
                'settings.view',
                'settings.appearance',
                'seo.*',
                'advertisements.*',
                'contacts.*',
                'analytics.view',
            ],
            self::EDITOR => [
                'dashboard.view',
                'pages.view',
                'pages.create',
                'pages.edit',
                'sections.*',
                'media.view',
                'media.upload',
                'contacts.view',
            ],
            self::VIEWER => [
                'dashboard.view',
                'pages.view',
                'media.view',
                'contacts.view',
                'analytics.view',
            ],
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn($role) => [
            $role->value => $role->label()
        ])->toArray();
    }
}
