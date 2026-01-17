<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'action',
        'subject_type',
        'subject_id',
        'properties',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected $casts = [
        'properties' => 'json',
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeAction($query, string $action)
    {
        return $query->where('action', $action);
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForSubject($query, Model $subject)
    {
        return $query->where('subject_type', get_class($subject))
            ->where('subject_id', $subject->id);
    }

    public function scopeRecent($query, int $limit = 50)
    {
        return $query->orderByDesc('created_at')->limit($limit);
    }

    public static function log(
        string $action,
        ?Model $subject = null,
        array $properties = [],
        ?User $user = null
    ): self {
        return static::create([
            'user_id' => $user?->id ?? auth()->id(),
            'action' => $action,
            'subject_type' => $subject ? get_class($subject) : null,
            'subject_id' => $subject?->id,
            'properties' => $properties,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
        ]);
    }

    public function getDescriptionAttribute(): string
    {
        $user = $this->user?->name ?? 'System';

        return match ($this->action) {
            'created' => "{$user} created a new {$this->getSubjectTypeName()}",
            'updated' => "{$user} updated {$this->getSubjectTypeName()}",
            'deleted' => "{$user} deleted {$this->getSubjectTypeName()}",
            'login' => "{$user} logged in",
            'logout' => "{$user} logged out",
            default => "{$user} performed {$this->action}",
        };
    }

    protected function getSubjectTypeName(): string
    {
        if (!$this->subject_type) {
            return 'item';
        }

        return strtolower(class_basename($this->subject_type));
    }
}
