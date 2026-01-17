<?php

namespace App\Models;

use App\Enums\MenuLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    protected $casts = [
        'location' => MenuLocation::class,
    ];

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('order');
    }

    public function rootItems(): HasMany
    {
        return $this->items()->whereNull('parent_id');
    }

    public function activeItems(): HasMany
    {
        return $this->items()->where('is_active', true);
    }

    public static function getByLocation(string|MenuLocation $location): ?self
    {
        $locationValue = $location instanceof MenuLocation ? $location->value : $location;

        return Cache::rememberForever('menu.' . $locationValue, function () use ($locationValue) {
            return static::where('location', $locationValue)
                ->with(['items' => function ($query) {
                    $query->where('is_active', true)
                        ->whereNull('parent_id')
                        ->orderBy('order')
                        ->with(['children' => function ($q) {
                            $q->where('is_active', true)->orderBy('order');
                        }, 'page']);
                }])
                ->first();
        });
    }

    public static function clearCache(?string $location = null): void
    {
        if ($location) {
            Cache::forget('menu.' . $location);
        } else {
            foreach (MenuLocation::cases() as $loc) {
                Cache::forget('menu.' . $loc->value);
            }
        }
    }

    protected static function booted(): void
    {
        static::saved(function ($menu) {
            static::clearCache($menu->location->value);
        });

        static::deleted(function ($menu) {
            static::clearCache($menu->location->value);
        });
    }
}
