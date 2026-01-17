<?php

namespace App\Services\Admin;

use App\Models\Setting;

class SettingsService
{
    public function get(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }

    public function set(string $key, mixed $value): void
    {
        Setting::set($key, $value);
    }

    public function getGroup(string $group): array
    {
        return Setting::getGroup($group);
    }

    public function setGroup(string $group, array $values): void
    {
        Setting::setGroup($group, $values);
    }

    public function getGeneralSettings(): array
    {
        return array_merge([
            'site_name' => config('app.name'),
            'site_tagline' => '',
            'site_description' => '',
            'admin_email' => '',
            'timezone' => config('app.timezone'),
            'date_format' => 'M d, Y',
            'time_format' => 'h:i A',
            'maintenance_mode' => false,
            'enable_analytics' => true,
        ], $this->getGroup('general'));
    }

    public function getAppearanceSettings(): array
    {
        $defaults = config('appearance');
        $saved = $this->getGroup('appearance');

        return array_merge($defaults, $saved);
    }

    public function getSeoSettings(): array
    {
        return array_merge([
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'google_analytics_id' => '',
            'google_search_console' => '',
            'facebook_pixel_id' => '',
            'robots_txt' => "User-agent: *\nAllow: /",
            'sitemap_enabled' => true,
        ], $this->getGroup('seo'));
    }

    public function getSecuritySettings(): array
    {
        return array_merge([
            'max_login_attempts' => 5,
            'lockout_duration' => 15,
            'password_min_length' => 8,
            'require_uppercase' => true,
            'require_number' => true,
            'require_special_char' => false,
            'session_timeout' => 120,
            'two_factor_enabled' => false,
        ], $this->getGroup('security'));
    }

    public function getEmailSettings(): array
    {
        return array_merge([
            'mail_driver' => config('mail.default'),
            'mail_host' => config('mail.mailers.smtp.host'),
            'mail_port' => config('mail.mailers.smtp.port'),
            'mail_username' => config('mail.mailers.smtp.username'),
            'mail_encryption' => config('mail.mailers.smtp.encryption'),
            'mail_from_address' => config('mail.from.address'),
            'mail_from_name' => config('mail.from.name'),
        ], $this->getGroup('email'));
    }

    public function getHeaderSettings(): array
    {
        return array_merge([
            'logo' => '',
            'logo_dark' => '',
            'favicon' => '',
            'header_style' => 'default',
            'sticky_header' => true,
            'show_search' => false,
            'cta_button_text' => '',
            'cta_button_url' => '',
            'social_links' => [],
        ], $this->getGroup('header'));
    }

    public function getFooterSettings(): array
    {
        return array_merge([
            'footer_style' => 'default',
            'columns' => 4,
            'copyright_text' => '© ' . date('Y') . ' ' . config('app.name') . '. All rights reserved.',
            'show_social_links' => true,
            'footer_logo' => '',
            'footer_description' => '',
        ], $this->getGroup('footer'));
    }

    public function clearCache(?string $group = null): void
    {
        Setting::clearCache($group);
    }
}
