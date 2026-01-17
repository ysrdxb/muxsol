<?php

namespace App\Livewire\Admin\Funnels;

use App\Models\Funnel;
use Livewire\Component;
use Livewire\WithPagination;

class FunnelList extends Component
{
    use WithPagination;

    public string $search = '';

    public function toggleStatus(int $id): void
    {
        $funnel = Funnel::findOrFail($id);
        $funnel->update(['is_active' => !$funnel->is_active]);
    }

    public function delete(int $id): void
    {
        Funnel::findOrFail($id)->delete();
        session()->flash('success', 'Funnel deleted successfully!');
    }

    public function render()
    {
        $funnels = Funnel::withCount('steps')
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.livewire.funnels.funnel-list', [
            'funnels' => $funnels,
        ])->layout('admin.layouts.app');
    }
}
