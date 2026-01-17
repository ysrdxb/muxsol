<?php

namespace App\Livewire\Admin\Workflows;

use App\Models\Workflow;
use Livewire\Component;
use Livewire\WithPagination;

class WorkflowList extends Component
{
    use WithPagination;

    public string $search = '';

    public function toggleStatus(int $id): void
    {
        $workflow = Workflow::findOrFail($id);
        $workflow->update(['is_active' => !$workflow->is_active]);
    }

    public function delete(int $id): void
    {
        Workflow::findOrFail($id)->delete();
        session()->flash('success', 'Workflow deleted successfully!');
    }

    public function render()
    {
        $workflows = Workflow::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.livewire.workflows.workflow-list', [
            'workflows' => $workflows,
        ])->layout('admin.layouts.app');
    }
}
