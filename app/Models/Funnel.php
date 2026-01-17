<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Funnel extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'views',
        'conversions',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'views' => 'integer',
        'conversions' => 'integer',
    ];

    public function steps(): HasMany
    {
        return $this->hasMany(FunnelStep::class)->orderBy('order');
    }

    public function activeSteps(): HasMany
    {
        return $this->steps()->where('is_active', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getFirstStep(): ?FunnelStep
    {
        return $this->activeSteps()->first();
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
    }

    public function recordConversion(): void
    {
        $this->increment('conversions');
    }

    public function getUrlAttribute(): string
    {
        return '/f/' . $this->slug;
    }

    public function duplicate(): self
    {
        $newFunnel = $this->replicate();
        $newFunnel->name = $this->name . ' (Copy)';
        $newFunnel->slug = null;
        $newFunnel->is_active = false;
        $newFunnel->views = 0;
        $newFunnel->conversions = 0;
        $newFunnel->save();

        foreach ($this->steps as $step) {
            $newStep = $step->replicate();
            $newStep->funnel_id = $newFunnel->id;
            $newStep->views = 0;
            $newStep->conversions = 0;
            $newStep->save();
        }

        return $newFunnel;
    }
}
