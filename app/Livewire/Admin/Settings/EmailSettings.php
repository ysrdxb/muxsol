<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;

class EmailSettings extends Component
{
    public string $mail_driver = 'smtp';
    public string $mail_host = '';
    public string $mail_port = '587';
    public string $mail_username = '';
    public string $mail_password = '';
    public string $mail_encryption = 'tls';
    public string $mail_from_address = '';
    public string $mail_from_name = '';

    public function mount(): void
    {
        $this->mail_driver = Setting::get('email.mail_driver', 'smtp');
        $this->mail_host = Setting::get('email.mail_host', '');
        $this->mail_port = Setting::get('email.mail_port', '587');
        $this->mail_username = Setting::get('email.mail_username', '');
        $this->mail_password = Setting::get('email.mail_password', '');
        $this->mail_encryption = Setting::get('email.mail_encryption', 'tls');
        $this->mail_from_address = Setting::get('email.mail_from_address', '');
        $this->mail_from_name = Setting::get('email.mail_from_name', '');
    }

    public function save(): void
    {
        Setting::set('email.mail_driver', $this->mail_driver);
        Setting::set('email.mail_host', $this->mail_host);
        Setting::set('email.mail_port', $this->mail_port);
        Setting::set('email.mail_username', $this->mail_username);
        Setting::set('email.mail_password', $this->mail_password);
        Setting::set('email.mail_encryption', $this->mail_encryption);
        Setting::set('email.mail_from_address', $this->mail_from_address);
        Setting::set('email.mail_from_name', $this->mail_from_name);

        session()->flash('success', 'Email settings saved successfully!');
    }

    public function render()
    {
        return view('admin.livewire.settings.email-settings')->layout('admin.layouts.app');
    }
}
