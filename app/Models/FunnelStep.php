<?php

namespace App\Models;

use App\Enums\FunnelStepType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class FunnelStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'funnel_id',
        'name',
        'slug',
        'type',
        'content',
        'settings',
        'order',
        'is_active',
        'views',
        'conversions',
    ];

    protected $casts = [
        'type' => FunnelStepType::class,
        'content' => 'json',
        'settings' => 'json',
        'is_active' => 'boolean',
        'order' => 'integer',
        'views' => 'integer',
        'conversions' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function ($step) {
            if (empty($step->slug)) {
                $step->slug = Str::slug($step->name);
            }
        });
    }

    public function funnel(): BelongsTo
    {
        return $this->belongsTo(Funnel::class);
    }

    public function getConversionRateAttribute(): float
    {
        if ($this->views === 0) {
            return 0;
        }

        return round(($this->conversions / $this->views) * 100, 2);
    }

    public function recordView(): void
    {
        $this->increment('views');
        $this->funnel->recordView();
    }

    public function recordConversion(): void
    {
        $this->increment('conversions');
    }

    public function getNextStep(): ?self
    {
        return $this->funnel->activeSteps()
            ->where('order', '>', $this->order)
            ->first();
    }

    public function getPreviousStep(): ?self
    {
        return $this->funnel->activeSteps()
            ->where('order', '<', $this->order)
            ->orderByDesc('order')
            ->first();
    }

    public function getUrlAttribute(): string
    {
        return $this->funnel->url . '/' . $this->slug;
    }

    public function getContentValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->content, $key, $default);
    }

    public function getSettingValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->settings, $key, $default);
    }
}
