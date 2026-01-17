<?php

namespace App\Models\Traits;

use App\Models\SeoMeta;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeo
{
    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function getSeoTitle(): string
    {
        return $this->seoMeta?->title ?? $this->title ?? $this->name ?? '';
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoMeta?->description ?? $this->excerpt ?? null;
    }

    public function getSeoImage(): ?string
    {
        return $this->seoMeta?->og_image ?? $this->featured_image ?? null;
    }

    public function updateSeo(array $data): void
    {
        $this->seoMeta()->updateOrCreate(
            ['seoable_type' => get_class($this), 'seoable_id' => $this->id],
            $data
        );
    }
}
