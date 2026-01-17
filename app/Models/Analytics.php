<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Analytics extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type',
        'page_id',
        'url',
        'referrer',
        'user_agent',
        'ip_address',
        'country',
        'city',
        'device',
        'browser',
        'os',
        'session_id',
        'metadata',
        'created_at',
    ];

    protected $casts = [
        'metadata' => 'json',
        'created_at' => 'datetime',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopePageViews($query)
    {
        return $query->where('type', 'page_view');
    }

    public function scopeDateRange($query, $start, $end)
    {
        return $query->whereBetween('created_at', [$start, $end]);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
    }

    public static function recordPageView(string $url, ?int $pageId = null, array $extra = []): self
    {
        return static::create([
            'type' => 'page_view',
            'page_id' => $pageId,
            'url' => $url,
            'referrer' => request()->header('referer'),
            'user_agent' => request()->userAgent(),
            'ip_address' => request()->ip(),
            'session_id' => session()->getId(),
            'metadata' => $extra,
            'created_at' => now(),
        ]);
    }

    public static function recordEvent(string $type, array $data = []): self
    {
        return static::create([
            'type' => $type,
            'url' => request()->url(),
            'referrer' => request()->header('referer'),
            'user_agent' => request()->userAgent(),
            'ip_address' => request()->ip(),
            'session_id' => session()->getId(),
            'metadata' => $data,
            'created_at' => now(),
        ]);
    }

    public static function getStats(string $period = 'today'): array
    {
        $query = match ($period) {
            'today' => static::today(),
            'week' => static::thisWeek(),
            'month' => static::thisMonth(),
            default => static::query(),
        };

        return [
            'page_views' => (clone $query)->pageViews()->count(),
            'unique_visitors' => (clone $query)->pageViews()->distinct('session_id')->count('session_id'),
            'form_submissions' => (clone $query)->type('form_submit')->count(),
        ];
    }
}
