<?php

namespace App\Livewire\Admin\Automations;

use App\Models\Automation;
use Livewire\Component;
use Livewire\WithPagination;

class AutomationList extends Component
{
    use WithPagination;

    public string $search = '';

    public function toggleStatus(int $id): void
    {
        $automation = Automation::findOrFail($id);
        $automation->update(['is_active' => !$automation->is_active]);
    }

    public function delete(int $id): void
    {
        Automation::findOrFail($id)->delete();
        session()->flash('success', 'Automation deleted successfully!');
    }

    public function render()
    {
        $automations = Automation::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.livewire.automations.automation-list', [
            'automations' => $automations,
        ])->layout('admin.layouts.app');
    }
}
