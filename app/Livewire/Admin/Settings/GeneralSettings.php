<?php

namespace App\Livewire\Admin\Settings;

use App\Models\ActivityLog;
use App\Services\Admin\SettingsService;
use Livewire\Component;

class GeneralSettings extends Component
{
    public string $site_name = '';
    public string $site_tagline = '';
    public string $site_description = '';
    public string $admin_email = '';
    public string $timezone = '';
    public string $date_format = '';
    public string $time_format = '';
    public bool $maintenance_mode = false;
    public bool $enable_analytics = true;

    protected SettingsService $settingsService;

    public function boot(SettingsService $settingsService): void
    {
        $this->settingsService = $settingsService;
    }

    public function mount(): void
    {
        $settings = $this->settingsService->getGeneralSettings();

        $this->site_name = $settings['site_name'] ?? '';
        $this->site_tagline = $settings['site_tagline'] ?? '';
        $this->site_description = $settings['site_description'] ?? '';
        $this->admin_email = $settings['admin_email'] ?? '';
        $this->timezone = $settings['timezone'] ?? 'UTC';
        $this->date_format = $settings['date_format'] ?? 'M d, Y';
        $this->time_format = $settings['time_format'] ?? 'h:i A';
        $this->maintenance_mode = $settings['maintenance_mode'] ?? false;
        $this->enable_analytics = $settings['enable_analytics'] ?? true;
    }

    public function save(): void
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:1000',
            'admin_email' => 'nullable|email',
            'timezone' => 'required|string',
            'date_format' => 'required|string',
            'time_format' => 'required|string',
        ]);

        $this->settingsService->setGroup('general', [
            'site_name' => $this->site_name,
            'site_tagline' => $this->site_tagline,
            'site_description' => $this->site_description,
            'admin_email' => $this->admin_email,
            'timezone' => $this->timezone,
            'date_format' => $this->date_format,
            'time_format' => $this->time_format,
            'maintenance_mode' => $this->maintenance_mode,
            'enable_analytics' => $this->enable_analytics,
        ]);

        ActivityLog::log('updated', null, ['group' => 'general_settings']);

        session()->flash('success', 'Settings saved successfully!');
    }

    public function render()
    {
        $timezones = timezone_identifiers_list();

        return view('admin.livewire.settings.general-settings', [
            'timezones' => $timezones,
        ])->layout('admin.layouts.app', ['title' => 'General Settings']);
    }
}
