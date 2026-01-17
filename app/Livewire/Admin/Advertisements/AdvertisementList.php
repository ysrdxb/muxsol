<?php

namespace App\Livewire\Admin\Advertisements;

use App\Models\Advertisement;
use Livewire\Component;
use Livewire\WithPagination;

class AdvertisementList extends Component
{
    use WithPagination;

    public string $search = '';

    public function toggleStatus(int $id): void
    {
        $ad = Advertisement::findOrFail($id);
        $ad->update(['is_active' => !$ad->is_active]);
    }

    public function delete(int $id): void
    {
        Advertisement::findOrFail($id)->delete();
        session()->flash('success', 'Advertisement deleted successfully!');
    }

    public function render()
    {
        $advertisements = Advertisement::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.livewire.advertisements.advertisement-list', [
            'advertisements' => $advertisements,
        ])->layout('admin.layouts.app');
    }
}
