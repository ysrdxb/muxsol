<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Auth Routes (with web middleware for sessions)
Route::prefix('admin')->name('admin.')->middleware('web')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Protected Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['web', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Pages
    Route::get('/pages', App\Livewire\Admin\Pages\PageList::class)->name('pages.index');
    Route::get('/pages/create', App\Livewire\Admin\Pages\PageEditor::class)->name('pages.create');
    Route::get('/pages/{id}/edit', App\Livewire\Admin\Pages\PageEditor::class)->name('pages.edit');

    // Sections
    Route::get('/sections', App\Livewire\Admin\Sections\SectionList::class)->name('sections.index');

    // Menus
    Route::get('/menus', App\Livewire\Admin\Menus\MenuList::class)->name('menus.index');
    Route::get('/menus/create', App\Livewire\Admin\Menus\MenuManager::class)->name('menus.create');
    Route::get('/menus/{menu}/edit', App\Livewire\Admin\Menus\MenuManager::class)->name('menus.edit');

    // Media
    Route::get('/media', App\Livewire\Admin\Media\MediaLibrary::class)->name('media.index');

    // Settings
    Route::get('/settings', App\Livewire\Admin\Settings\GeneralSettings::class)->name('settings.index');
    Route::get('/settings/appearance', App\Livewire\Admin\Settings\AppearanceSettings::class)->name('settings.appearance');
    Route::get('/settings/header-footer', App\Livewire\Admin\Settings\HeaderFooterSettings::class)->name('settings.header-footer');
    Route::get('/settings/seo', App\Livewire\Admin\Settings\SeoSettings::class)->name('settings.seo');
    Route::get('/settings/security', App\Livewire\Admin\Settings\SecuritySettings::class)->name('settings.security');
    Route::get('/settings/email', App\Livewire\Admin\Settings\EmailSettings::class)->name('settings.email');

    // Advertisements
    Route::get('/advertisements', App\Livewire\Admin\Advertisements\AdvertisementList::class)->name('advertisements.index');
    Route::get('/advertisements/create', App\Livewire\Admin\Advertisements\AdvertisementEditor::class)->name('advertisements.create');
    Route::get('/advertisements/{id}/edit', App\Livewire\Admin\Advertisements\AdvertisementEditor::class)->name('advertisements.edit');

    // Contacts
    Route::get('/contacts', App\Livewire\Admin\Contacts\ContactList::class)->name('contacts.index');

    // Workflows
    Route::get('/workflows', App\Livewire\Admin\Workflows\WorkflowList::class)->name('workflows.index');
    Route::get('/workflows/create', App\Livewire\Admin\Workflows\WorkflowEditor::class)->name('workflows.create');
    Route::get('/workflows/{workflow}/edit', App\Livewire\Admin\Workflows\WorkflowEditor::class)->name('workflows.edit');

    // Funnels
    Route::get('/funnels', App\Livewire\Admin\Funnels\FunnelList::class)->name('funnels.index');
    Route::get('/funnels/create', App\Livewire\Admin\Funnels\FunnelEditor::class)->name('funnels.create');
    Route::get('/funnels/{funnel}/edit', App\Livewire\Admin\Funnels\FunnelEditor::class)->name('funnels.edit');

    // Automations
    Route::get('/automations', App\Livewire\Admin\Automations\AutomationList::class)->name('automations.index');

    // Email Templates
    Route::get('/email-templates', App\Livewire\Admin\EmailTemplates\EmailTemplateList::class)->name('email-templates.index');
    Route::get('/email-templates/create', App\Livewire\Admin\EmailTemplates\EmailTemplateEditor::class)->name('email-templates.create');
    Route::get('/email-templates/{id}/edit', App\Livewire\Admin\EmailTemplates\EmailTemplateEditor::class)->name('email-templates.edit');

    // Analytics
    Route::get('/analytics', App\Livewire\Admin\Analytics\AnalyticsDashboard::class)->name('analytics.index');

    // Backups
    Route::get('/backups', App\Livewire\Admin\Backups\BackupManager::class)->name('backups.index');

    // Users
    Route::get('/users', App\Livewire\Admin\Users\UserList::class)->name('users.index');
    Route::get('/users/create', App\Livewire\Admin\Users\UserEditor::class)->name('users.create');
    Route::get('/users/{id}/edit', App\Livewire\Admin\Users\UserEditor::class)->name('users.edit');

    // Activity Log
    Route::get('/activity-log', App\Livewire\Admin\ActivityLogs\ActivityLogList::class)->name('activity-log.index');
});
