<?php

namespace App\Models;

use App\Enums\AdPosition;
use App\Enums\AdType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'type',
        'content',
        'url',
        'start_date',
        'end_date',
        'is_active',
        'impressions',
        'clicks',
    ];

    protected $casts = [
        'position' => AdPosition::class,
        'type' => AdType::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'impressions' => 'integer',
        'clicks' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('start_date')
                    ->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            });
    }

    public function scopePosition($query, string|AdPosition $position)
    {
        $positionValue = $position instanceof AdPosition ? $position->value : $position;
        return $query->where('position', $positionValue);
    }

    public function isActive(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now()->startOfDay();

        if ($this->start_date && $this->start_date > $now) {
            return false;
        }

        if ($this->end_date && $this->end_date < $now) {
            return false;
        }

        return true;
    }

    public function recordImpression(): void
    {
        $this->increment('impressions');
    }

    public function recordClick(): void
    {
        $this->increment('clicks');
    }

    public function getCtrAttribute(): float
    {
        if ($this->impressions === 0) {
            return 0;
        }

        return round(($this->clicks / $this->impressions) * 100, 2);
    }

    public function render(): string
    {
        return match ($this->type) {
            AdType::IMAGE => $this->renderImage(),
            AdType::HTML => $this->content,
            AdType::SCRIPT => '<script>' . $this->content . '</script>',
        };
    }

    protected function renderImage(): string
    {
        $html = '<img src="' . asset('storage/' . $this->content) . '" alt="' . e($this->name) . '" class="ad-image">';

        if ($this->url) {
            $html = '<a href="' . e($this->url) . '" target="_blank" rel="noopener" class="ad-link" data-ad-id="' . $this->id . '">' . $html . '</a>';
        }

        return $html;
    }
}
