<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'parent_id',
        'title',
        'url',
        'page_id',
        'target',
        'icon',
        'custom_class',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function activeChildren(): HasMany
    {
        return $this->children()->where('is_active', true);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function getUrlAttribute(): string
    {
        if ($this->page_id && $this->page) {
            return $this->page->url;
        }

        return $this->attributes['url'] ?? '#';
    }

    public function hasChildren(): bool
    {
        return $this->children()->where('is_active', true)->exists();
    }

    public function isActive(): bool
    {
        $currentUrl = request()->path();
        $itemUrl = ltrim($this->url, '/');

        if ($itemUrl === $currentUrl || ($itemUrl === '' && $currentUrl === '/')) {
            return true;
        }

        foreach ($this->children as $child) {
            if ($child->isActive()) {
                return true;
            }
        }

        return false;
    }

    protected static function booted(): void
    {
        static::saved(function ($item) {
            Menu::clearCache($item->menu?->location?->value);
        });

        static::deleted(function ($item) {
            Menu::clearCache($item->menu?->location?->value);
        });
    }
}
