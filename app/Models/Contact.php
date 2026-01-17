<?php

namespace App\Models;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'message',
        'source',
        'status',
        'metadata',
    ];

    protected $casts = [
        'status' => ContactStatus::class,
        'metadata' => 'json',
    ];

    public function scopeStatus($query, string|ContactStatus $status)
    {
        $statusValue = $status instanceof ContactStatus ? $status->value : $status;
        return $query->where('status', $statusValue);
    }

    public function scopeSource($query, string $source)
    {
        return $query->where('source', $source);
    }

    public function scopeNew($query)
    {
        return $query->where('status', ContactStatus::NEW);
    }

    public function markAsContacted(): void
    {
        $this->update(['status' => ContactStatus::CONTACTED]);
    }

    public function markAsQualified(): void
    {
        $this->update(['status' => ContactStatus::QUALIFIED]);
    }

    public function markAsConverted(): void
    {
        $this->update(['status' => ContactStatus::CONVERTED]);
    }

    public function markAsClosed(): void
    {
        $this->update(['status' => ContactStatus::CLOSED]);
    }

    public function getMetadataValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->metadata, $key, $default);
    }

    public function setMetadataValue(string $key, mixed $value): void
    {
        $metadata = $this->metadata ?? [];
        data_set($metadata, $key, $value);
        $this->update(['metadata' => $metadata]);
    }
}
