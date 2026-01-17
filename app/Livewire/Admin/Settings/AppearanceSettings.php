<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;

class AppearanceSettings extends Component
{
    public string $primary_color = '#3B82F6';
    public string $secondary_color = '#10B981';
    public string $accent_color = '#8B5CF6';
    public string $font_family = 'Inter';
    public string $heading_font = 'Inter';
    public string $body_font_size = '16';
    public string $heading_font_size = '32';

    public function mount(): void
    {
        $this->primary_color = Setting::get('appearance.primary_color', '#3B82F6');
        $this->secondary_color = Setting::get('appearance.secondary_color', '#10B981');
        $this->accent_color = Setting::get('appearance.accent_color', '#8B5CF6');
        $this->font_family = Setting::get('appearance.font_family', 'Inter');
        $this->heading_font = Setting::get('appearance.heading_font', 'Inter');
        $this->body_font_size = Setting::get('appearance.body_font_size', '16');
        $this->heading_font_size = Setting::get('appearance.heading_font_size', '32');
    }

    public function save(): void
    {
        Setting::set('appearance.primary_color', $this->primary_color);
        Setting::set('appearance.secondary_color', $this->secondary_color);
        Setting::set('appearance.accent_color', $this->accent_color);
        Setting::set('appearance.font_family', $this->font_family);
        Setting::set('appearance.heading_font', $this->heading_font);
        Setting::set('appearance.body_font_size', $this->body_font_size);
        Setting::set('appearance.heading_font_size', $this->heading_font_size);

        session()->flash('success', 'Appearance settings saved successfully!');
    }

    public function render()
    {
        $fonts = config('appearance.fonts', [
            'Inter', 'Roboto', 'Open Sans', 'Lato', 'Poppins',
            'Montserrat', 'Nunito', 'Raleway', 'Ubuntu', 'Playfair Display',
        ]);

        return view('admin.livewire.settings.appearance-settings', [
            'fonts' => $fonts,
        ])->layout('admin.layouts.app');
    }
}
