<?php

namespace App\Livewire\Admin\Workflows;

use App\Models\Workflow;
use Livewire\Component;

class WorkflowEditor extends Component
{
    public ?Workflow $workflow = null;
    public string $name = '';
    public string $description = '';
    public string $trigger_type = 'form_submit';
    public bool $is_active = true;

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->workflow = Workflow::findOrFail($id);
            $this->name = $this->workflow->name;
            $this->description = $this->workflow->description ?? '';
            $this->trigger_type = $this->workflow->trigger_type;
            $this->is_active = $this->workflow->is_active;
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|min:2|max:255',
            'trigger_type' => 'required',
        ]);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'trigger_type' => $this->trigger_type,
            'trigger_config' => [],
            'is_active' => $this->is_active,
        ];

        if ($this->workflow) {
            $this->workflow->update($data);
        } else {
            $this->workflow = Workflow::create($data);
        }

        session()->flash('success', 'Workflow saved successfully!');
    }

    public function render()
    {
        return view('admin.livewire.workflows.workflow-editor')->layout('admin.layouts.app');
    }
}
