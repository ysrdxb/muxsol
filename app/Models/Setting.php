<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'group',
        'key',
        'value',
    ];

    protected $casts = [
        'value' => 'json',
    ];

    public static function get(string $key, mixed $default = null): mixed
    {
        $cacheKey = 'settings.' . $key;

        return Cache::rememberForever($cacheKey, function () use ($key, $default) {
            [$group, $settingKey] = explode('.', $key, 2) + [null, null];

            if (!$settingKey) {
                return $default;
            }

            $setting = static::where('group', $group)
                ->where('key', $settingKey)
                ->first();

            return $setting?->value ?? $default;
        });
    }

    public static function set(string $key, mixed $value): void
    {
        [$group, $settingKey] = explode('.', $key, 2) + [null, null];

        if (!$settingKey) {
            return;
        }

        static::updateOrCreate(
            ['group' => $group, 'key' => $settingKey],
            ['value' => $value]
        );

        Cache::forget('settings.' . $key);
    }

    public static function getGroup(string $group): array
    {
        $cacheKey = 'settings.group.' . $group;

        return Cache::rememberForever($cacheKey, function () use ($group) {
            return static::where('group', $group)
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    public static function setGroup(string $group, array $values): void
    {
        foreach ($values as $key => $value) {
            static::set($group . '.' . $key, $value);
        }

        Cache::forget('settings.group.' . $group);
    }

    public static function clearCache(?string $group = null): void
    {
        if ($group) {
            Cache::forget('settings.group.' . $group);
            $settings = static::where('group', $group)->get();
            foreach ($settings as $setting) {
                Cache::forget('settings.' . $group . '.' . $setting->key);
            }
        } else {
            $settings = static::all();
            foreach ($settings as $setting) {
                Cache::forget('settings.' . $setting->group . '.' . $setting->key);
                Cache::forget('settings.group.' . $setting->group);
            }
        }
    }
}
