<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMeta extends Model
{
    use HasFactory;

    protected $fillable = [
        'seoable_type',
        'seoable_id',
        'title',
        'description',
        'keywords',
        'og_title',
        'og_description',
        'og_image',
        'twitter_card',
        'canonical_url',
        'robots',
        'schema_markup',
    ];

    protected $casts = [
        'schema_markup' => 'json',
    ];

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getOgTitleAttribute($value): string
    {
        return $value ?? $this->title ?? '';
    }

    public function getOgDescriptionAttribute($value): ?string
    {
        return $value ?? $this->description;
    }

    public function toMetaTags(): array
    {
        $tags = [];

        if ($this->title) {
            $tags[] = ['name' => 'title', 'content' => $this->title];
        }

        if ($this->description) {
            $tags[] = ['name' => 'description', 'content' => $this->description];
        }

        if ($this->keywords) {
            $tags[] = ['name' => 'keywords', 'content' => $this->keywords];
        }

        if ($this->robots) {
            $tags[] = ['name' => 'robots', 'content' => $this->robots];
        }

        if ($this->og_title) {
            $tags[] = ['property' => 'og:title', 'content' => $this->og_title];
        }

        if ($this->og_description) {
            $tags[] = ['property' => 'og:description', 'content' => $this->og_description];
        }

        if ($this->og_image) {
            $tags[] = ['property' => 'og:image', 'content' => asset('storage/' . $this->og_image)];
        }

        if ($this->twitter_card) {
            $tags[] = ['name' => 'twitter:card', 'content' => $this->twitter_card];
        }

        if ($this->canonical_url) {
            $tags[] = ['rel' => 'canonical', 'href' => $this->canonical_url];
        }

        return $tags;
    }
}
