<?php

namespace App\Models;

use App\Enums\BackupStatus;
use App\Enums\BackupType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Backup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'path',
        'size',
        'status',
        'created_by',
    ];

    protected $casts = [
        'type' => BackupType::class,
        'status' => BackupStatus::class,
        'size' => 'integer',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', BackupStatus::COMPLETED);
    }

    public function scopeType($query, string|BackupType $type)
    {
        $typeValue = $type instanceof BackupType ? $type->value : $type;
        return $query->where('type', $typeValue);
    }

    public function isCompleted(): bool
    {
        return $this->status === BackupStatus::COMPLETED;
    }

    public function isPending(): bool
    {
        return $this->status === BackupStatus::PENDING;
    }

    public function isProcessing(): bool
    {
        return $this->status === BackupStatus::PROCESSING;
    }

    public function isFailed(): bool
    {
        return $this->status === BackupStatus::FAILED;
    }

    public function markAsProcessing(): void
    {
        $this->update(['status' => BackupStatus::PROCESSING]);
    }

    public function markAsCompleted(string $path, int $size): void
    {
        $this->update([
            'status' => BackupStatus::COMPLETED,
            'path' => $path,
            'size' => $size,
        ]);
    }

    public function markAsFailed(): void
    {
        $this->update(['status' => BackupStatus::FAILED]);
    }

    public function getDownloadUrl(): ?string
    {
        if (!$this->isCompleted() || !$this->path) {
            return null;
        }

        return Storage::url($this->path);
    }

    public function getHumanReadableSizeAttribute(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function delete(): bool
    {
        if ($this->path && Storage::exists($this->path)) {
            Storage::delete($this->path);
        }

        return parent::delete();
    }
}
