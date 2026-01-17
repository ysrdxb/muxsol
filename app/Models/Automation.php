<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'trigger',
        'config',
        'is_active',
        'runs_count',
        'last_run_at',
    ];

    protected $casts = [
        'config' => 'json',
        'is_active' => 'boolean',
        'runs_count' => 'integer',
        'last_run_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeTrigger($query, string $trigger)
    {
        return $query->where('trigger', $trigger);
    }

    public function recordRun(): void
    {
        $this->increment('runs_count');
        $this->update(['last_run_at' => now()]);
    }

    public function getConfigValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->config, $key, $default);
    }

    public function setConfigValue(string $key, mixed $value): void
    {
        $config = $this->config ?? [];
        data_set($config, $key, $value);
        $this->update(['config' => $config]);
    }
}
