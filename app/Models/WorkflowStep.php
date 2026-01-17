<?php

namespace App\Models;

use App\Enums\WorkflowActionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkflowStep extends Model
{
    use HasFactory;

    protected $fillable = [
        'workflow_id',
        'type',
        'config',
        'order',
    ];

    protected $casts = [
        'type' => WorkflowActionType::class,
        'config' => 'json',
        'order' => 'integer',
    ];

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class);
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

    public function getNextStep(): ?self
    {
        return $this->workflow->steps()
            ->where('order', '>', $this->order)
            ->orderBy('order')
            ->first();
    }

    public function getPreviousStep(): ?self
    {
        return $this->workflow->steps()
            ->where('order', '<', $this->order)
            ->orderByDesc('order')
            ->first();
    }
}
