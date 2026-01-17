<?php

namespace App\Models;

use App\Enums\SectionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'type',
        'title',
        'subtitle',
        'content',
        'settings',
        'order',
        'is_active',
        'custom_css',
        'custom_class',
    ];

    protected $casts = [
        'type' => SectionType::class,
        'content' => 'json',
        'settings' => 'json',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function getViewName(): string
    {
        return $this->type->view();
    }

    public function getConfig(): array
    {
        return config('sections.types.' . $this->type->value, []);
    }

    public function getContentValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->content, $key, $default);
    }

    public function getSettingValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->settings, $key, $default);
    }

    public function render(): string
    {
        $viewName = $this->getViewName();

        if (!view()->exists($viewName)) {
            return '';
        }

        return view($viewName, [
            'section' => $this,
            'content' => $this->content ?? [],
            'settings' => $this->settings ?? [],
        ])->render();
    }
}
