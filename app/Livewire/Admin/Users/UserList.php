<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public string $search = '';

    public function toggleStatus(int $id): void
    {
        $user = User::findOrFail($id);
        if ($user->id !== auth()->id()) {
            $user->update(['is_active' => !$user->is_active]);
        }
    }

    public function delete(int $id): void
    {
        $user = User::findOrFail($id);
        if ($user->id !== auth()->id()) {
            $user->delete();
            session()->flash('success', 'User deleted successfully!');
        }
    }

    public function render()
    {
        $users = User::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.livewire.users.user-list', [
            'users' => $users,
        ])->layout('admin.layouts.app');
    }
}
