<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Menu;
use App\Services\Admin\SettingsService;
use Livewire\Component;
use Livewire\WithFileUploads;

class HeaderFooterSettings extends Component
{
    use WithFileUploads;

    // Header Settings
    public string $header_style = 'default';
    public bool $header_sticky = true;
    public bool $header_transparent = false;
    public ?string $header_menu = null;
    public bool $header_cta_enabled = true;
    public string $header_cta_text = 'Get Started';
    public string $header_cta_url = '/contact';
    public bool $header_search_enabled = false;
    public bool $header_social_enabled = false;

    // Logo Settings
    public ?string $logo = null;
    public ?string $logo_dark = null;
    public $newLogo;
    public $newLogoDark;
    public string $logo_height = '40';

    // Footer Settings
    public string $footer_style = 'default';
    public int $footer_columns = 4;
    public ?string $footer_menu = null;
    public string $footer_copyright = '';
    public bool $footer_social_enabled = true;
    public string $footer_description = '';

    // Social Links
    public string $social_facebook = '';
    public string $social_twitter = '';
    public string $social_instagram = '';
    public string $social_linkedin = '';
    public string $social_youtube = '';
    public string $social_github = '';

    // Footer Widgets
    public array $footer_widgets = [];

    protected SettingsService $settingsService;

    public function boot(SettingsService $settingsService): void
    {
        $this->settingsService = $settingsService;
    }

    public function mount(): void
    {
        $this->loadSettings();
    }

    protected function loadSettings(): void
    {
        // Header
        $this->header_style = $this->settingsService->get('header.style', 'default');
        $this->header_sticky = $this->settingsService->get('header.sticky', true);
        $this->header_transparent = $this->settingsService->get('header.transparent', false);
        $this->header_menu = $this->settingsService->get('header.menu');
        $this->header_cta_enabled = $this->settingsService->get('header.cta_enabled', true);
        $this->header_cta_text = $this->settingsService->get('header.cta_text', 'Get Started');
        $this->header_cta_url = $this->settingsService->get('header.cta_url', '/contact');
        $this->header_search_enabled = $this->settingsService->get('header.search_enabled', false);
        $this->header_social_enabled = $this->settingsService->get('header.social_enabled', false);

        // Logo
        $this->logo = $this->settingsService->get('general.logo');
        $this->logo_dark = $this->settingsService->get('general.logo_dark');
        $this->logo_height = $this->settingsService->get('header.logo_height', '40');

        // Footer
        $this->footer_style = $this->settingsService->get('footer.style', 'default');
        $this->footer_columns = $this->settingsService->get('footer.columns', 4);
        $this->footer_menu = $this->settingsService->get('footer.menu');
        $this->footer_copyright = $this->settingsService->get('footer.copyright', '© ' . date('Y') . ' ' . config('app.name') . '. All rights reserved.');
        $this->footer_social_enabled = $this->settingsService->get('footer.social_enabled', true);
        $this->footer_description = $this->settingsService->get('footer.description', '');
        $this->footer_widgets = $this->settingsService->get('footer.widgets', []);

        // Social Links
        $this->social_facebook = $this->settingsService->get('social.facebook', '');
        $this->social_twitter = $this->settingsService->get('social.twitter', '');
        $this->social_instagram = $this->settingsService->get('social.instagram', '');
        $this->social_linkedin = $this->settingsService->get('social.linkedin', '');
        $this->social_youtube = $this->settingsService->get('social.youtube', '');
        $this->social_github = $this->settingsService->get('social.github', '');
    }

    public function updatedNewLogo(): void
    {
        $this->validate(['newLogo' => 'image|max:1024']);
    }

    public function updatedNewLogoDark(): void
    {
        $this->validate(['newLogoDark' => 'image|max:1024']);
    }

    public function saveHeader(): void
    {
        $this->validate([
            'header_style' => 'required|in:default,centered,minimal',
            'header_cta_text' => 'required_if:header_cta_enabled,true|max:50',
            'header_cta_url' => 'required_if:header_cta_enabled,true|max:255',
            'logo_height' => 'required|numeric|min:20|max:100',
        ]);

        // Handle logo upload
        if ($this->newLogo) {
            $path = $this->newLogo->store('logos', 'public');
            $this->logo = '/storage/' . $path;
            $this->settingsService->set('general.logo', $this->logo);
        }

        if ($this->newLogoDark) {
            $path = $this->newLogoDark->store('logos', 'public');
            $this->logo_dark = '/storage/' . $path;
            $this->settingsService->set('general.logo_dark', $this->logo_dark);
        }

        $this->settingsService->set('header.style', $this->header_style);
        $this->settingsService->set('header.sticky', $this->header_sticky);
        $this->settingsService->set('header.transparent', $this->header_transparent);
        $this->settingsService->set('header.menu', $this->header_menu);
        $this->settingsService->set('header.cta_enabled', $this->header_cta_enabled);
        $this->settingsService->set('header.cta_text', $this->header_cta_text);
        $this->settingsService->set('header.cta_url', $this->header_cta_url);
        $this->settingsService->set('header.search_enabled', $this->header_search_enabled);
        $this->settingsService->set('header.social_enabled', $this->header_social_enabled);
        $this->settingsService->set('header.logo_height', $this->logo_height);

        $this->newLogo = null;
        $this->newLogoDark = null;

        session()->flash('header_success', 'Header settings saved successfully!');
    }

    public function saveFooter(): void
    {
        $this->validate([
            'footer_style' => 'required|in:default,minimal,centered',
            'footer_columns' => 'required|integer|min:1|max:6',
            'footer_copyright' => 'required|max:500',
        ]);

        $this->settingsService->set('footer.style', $this->footer_style);
        $this->settingsService->set('footer.columns', $this->footer_columns);
        $this->settingsService->set('footer.menu', $this->footer_menu);
        $this->settingsService->set('footer.copyright', $this->footer_copyright);
        $this->settingsService->set('footer.social_enabled', $this->footer_social_enabled);
        $this->settingsService->set('footer.description', $this->footer_description);
        $this->settingsService->set('footer.widgets', $this->footer_widgets);

        session()->flash('footer_success', 'Footer settings saved successfully!');
    }

    public function saveSocial(): void
    {
        $this->validate([
            'social_facebook' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_github' => 'nullable|url|max:255',
        ]);

        $this->settingsService->set('social.facebook', $this->social_facebook);
        $this->settingsService->set('social.twitter', $this->social_twitter);
        $this->settingsService->set('social.instagram', $this->social_instagram);
        $this->settingsService->set('social.linkedin', $this->social_linkedin);
        $this->settingsService->set('social.youtube', $this->social_youtube);
        $this->settingsService->set('social.github', $this->social_github);

        session()->flash('social_success', 'Social links saved successfully!');
    }

    public function removeLogo(): void
    {
        $this->logo = null;
        $this->settingsService->set('general.logo', null);
    }

    public function removeLogoDark(): void
    {
        $this->logo_dark = null;
        $this->settingsService->set('general.logo_dark', null);
    }

    public function render()
    {
        return view('admin.livewire.settings.header-footer-settings', [
            'menus' => Menu::all(),
            'headerStyles' => [
                'default' => 'Default (Logo Left, Menu Right)',
                'centered' => 'Centered (Logo Center)',
                'minimal' => 'Minimal (Clean)',
            ],
            'footerStyles' => [
                'default' => 'Default (Multi-column)',
                'minimal' => 'Minimal (Single row)',
                'centered' => 'Centered',
            ],
        ])->layout('admin.layouts.app');
    }
}
