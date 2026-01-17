<?php

namespace App\Livewire\Admin\Menus;

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithPagination;

class MenuList extends Component
{
    use WithPagination;

    public string $search = '';

    public function deleteMenu(int $id): void
    {
        $menu = Menu::findOrFail($id);
        $menu->items()->delete();
        $menu->delete();
        Menu::clearCache();

        session()->flash('success', 'Menu deleted successfully!');
    }

    public function render()
    {
        $menus = Menu::withCount('items')
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.livewire.menus.menu-list', [
            'menus' => $menus,
        ])->layout('admin.layouts.app');
    }
}
