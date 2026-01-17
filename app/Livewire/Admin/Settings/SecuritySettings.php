<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;

class SecuritySettings extends Component
{
    public bool $maintenance_mode = false;
    public string $maintenance_message = '';
    public int $login_attempts = 5;
    public int $lockout_duration = 15;

    public function mount(): void
    {
        $this->maintenance_mode = Setting::get('security.maintenance_mode', false);
        $this->maintenance_message = Setting::get('security.maintenance_message', 'We are currently performing maintenance. Please check back soon.');
        $this->login_attempts = Setting::get('security.login_attempts', 5);
        $this->lockout_duration = Setting::get('security.lockout_duration', 15);
    }

    public function save(): void
    {
        Setting::set('security.maintenance_mode', $this->maintenance_mode);
        Setting::set('security.maintenance_message', $this->maintenance_message);
        Setting::set('security.login_attempts', $this->login_attempts);
        Setting::set('security.lockout_duration', $this->lockout_duration);

        session()->flash('success', 'Security settings saved successfully!');
    }

    public function render()
    {
        return view('admin.livewire.settings.security-settings')->layout('admin.layouts.app');
    }
}
