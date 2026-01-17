<?php

namespace App\Models;

use App\Enums\WorkflowTrigger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workflow extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'trigger_type',
        'trigger_config',
        'is_active',
        'runs_count',
        'last_run_at',
    ];

    protected $casts = [
        'trigger_type' => WorkflowTrigger::class,
        'trigger_config' => 'json',
        'is_active' => 'boolean',
        'runs_count' => 'integer',
        'last_run_at' => 'datetime',
    ];

    public function steps(): HasMany
    {
        return $this->hasMany(WorkflowStep::class)->orderBy('order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeTrigger($query, string|WorkflowTrigger $trigger)
    {
        $triggerValue = $trigger instanceof WorkflowTrigger ? $trigger->value : $trigger;
        return $query->where('trigger_type', $triggerValue);
    }

    public function recordRun(): void
    {
        $this->increment('runs_count');
        $this->update(['last_run_at' => now()]);
    }

    public function getTriggerConfigValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->trigger_config, $key, $default);
    }

    public function duplicate(): self
    {
        $newWorkflow = $this->replicate();
        $newWorkflow->name = $this->name . ' (Copy)';
        $newWorkflow->is_active = false;
        $newWorkflow->runs_count = 0;
        $newWorkflow->last_run_at = null;
        $newWorkflow->save();

        foreach ($this->steps as $step) {
            $newStep = $step->replicate();
            $newStep->workflow_id = $newWorkflow->id;
            $newStep->save();
        }

        return $newWorkflow;
    }
}
