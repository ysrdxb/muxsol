<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug($model->title ?? $model->name);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') || $model->isDirty('name')) {
                $source = $model->title ?? $model->name;
                if (!empty($source) && empty($model->slug)) {
                    $model->slug = $model->generateUniqueSlug($source);
                }
            }
        });
    }

    protected function generateUniqueSlug(string $source): string
    {
        $slug = Str::slug($source);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
