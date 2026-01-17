<?php

namespace App\Models;

use App\Enums\PageStatus;
use App\Models\Traits\HasSeo;
use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, HasSlug, HasSeo, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'template',
        'status',
        'published_at',
        'author_id',
        'parent_id',
        'order',
        'is_homepage',
        'show_in_menu',
    ];

    protected $casts = [
        'status' => PageStatus::class,
        'published_at' => 'datetime',
        'is_homepage' => 'boolean',
        'show_in_menu' => 'boolean',
        'order' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('order');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('order');
    }

    public function activeSections(): HasMany
    {
        return $this->sections()->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('status', PageStatus::PUBLISHED)
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function scopeHomepage($query)
    {
        return $query->where('is_homepage', true);
    }

    public function isPublished(): bool
    {
        return $this->status === PageStatus::PUBLISHED &&
            ($this->published_at === null || $this->published_at <= now());
    }

    public function getUrlAttribute(): string
    {
        if ($this->is_homepage) {
            return '/';
        }

        return '/' . $this->slug;
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }

        return null;
    }

    public static function getHomepage(): ?self
    {
        return static::homepage()->published()->first();
    }
}
