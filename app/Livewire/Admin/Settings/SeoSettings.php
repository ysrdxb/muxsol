<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;

class SeoSettings extends Component
{
    public string $meta_title_suffix = '';
    public string $default_meta_description = '';
    public string $google_analytics_id = '';
    public string $google_search_console = '';
    public bool $enable_sitemap = true;

    public function mount(): void
    {
        $this->meta_title_suffix = Setting::get('seo.meta_title_suffix', '');
        $this->default_meta_description = Setting::get('seo.default_meta_description', '');
        $this->google_analytics_id = Setting::get('seo.google_analytics_id', '');
        $this->google_search_console = Setting::get('seo.google_search_console', '');
        $this->enable_sitemap = Setting::get('seo.enable_sitemap', true);
    }

    public function save(): void
    {
        Setting::set('seo.meta_title_suffix', $this->meta_title_suffix);
        Setting::set('seo.default_meta_description', $this->default_meta_description);
        Setting::set('seo.google_analytics_id', $this->google_analytics_id);
        Setting::set('seo.google_search_console', $this->google_search_console);
        Setting::set('seo.enable_sitemap', $this->enable_sitemap);

        session()->flash('success', 'SEO settings saved successfully!');
    }

    public function render()
    {
        return view('admin.livewire.settings.seo-settings')->layout('admin.layouts.app');
    }
}
