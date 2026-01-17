<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_name',
        'mime_type',
        'path',
        'disk',
        'size',
        'dimensions',
        'alt_text',
        'caption',
        'folder',
        'uploaded_by',
    ];

    protected $casts = [
        'dimensions' => 'json',
        'size' => 'integer',
    ];

    protected $appends = ['url', 'thumbnail_url'];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    public function getThumbnailUrlAttribute(): string
    {
        if ($this->isImage()) {
            $thumbnailPath = str_replace(
                pathinfo($this->path, PATHINFO_FILENAME),
                pathinfo($this->path, PATHINFO_FILENAME) . '_thumb',
                $this->path
            );

            if (Storage::disk($this->disk)->exists($thumbnailPath)) {
                return Storage::disk($this->disk)->url($thumbnailPath);
            }
        }

        return $this->url;
    }

    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    public function isVideo(): bool
    {
        return str_starts_with($this->mime_type, 'video/');
    }

    public function isDocument(): bool
    {
        return in_array($this->mime_type, [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ]);
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

    public function getExtensionAttribute(): string
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    public function delete(): bool
    {
        Storage::disk($this->disk)->delete($this->path);

        if ($this->isImage()) {
            $thumbnailPath = str_replace(
                pathinfo($this->path, PATHINFO_FILENAME),
                pathinfo($this->path, PATHINFO_FILENAME) . '_thumb',
                $this->path
            );
            Storage::disk($this->disk)->delete($thumbnailPath);
        }

        return parent::delete();
    }

    public static function getFolders(): array
    {
        return static::distinct()
            ->pluck('folder')
            ->filter()
            ->sort()
            ->values()
            ->toArray();
    }
}
