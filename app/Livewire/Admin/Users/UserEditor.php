<?php

namespace App\Livewire\Admin\Users;

use App\Enums\UserRole;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserEditor extends Component
{
    public ?User $user = null;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'editor';
    public bool $is_active = true;

    public bool $showDeleteModal = false;

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->user = User::findOrFail($id);
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            $this->role = $this->user->role->value;
            $this->is_active = $this->user->is_active;
        }
    }

    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|min:2|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user?->id),
            ],
            'role' => 'required|in:' . implode(',', array_column(UserRole::cases(), 'value')),
            'is_active' => 'boolean',
        ];

        if (!$this->user) {
            $rules['password'] = 'required|string|min:8|confirmed';
        } else {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        return $rules;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => UserRole::from($this->role),
            'is_active' => $this->is_active,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->user) {
            // Prevent deactivating yourself
            if ($this->user->id === auth()->id() && !$this->is_active) {
                session()->flash('error', 'You cannot deactivate your own account.');
                return;
            }

            // Prevent changing your own role
            if ($this->user->id === auth()->id() && $this->role !== $this->user->role->value) {
                session()->flash('error', 'You cannot change your own role.');
                return;
            }

            $this->user->update($data);
            ActivityLog::log('update', $this->user, 'Updated user: ' . $this->user->name);
            session()->flash('success', 'User updated successfully!');
        } else {
            $user = User::create($data);
            ActivityLog::log('create', $user, 'Created user: ' . $user->name);
            session()->flash('success', 'User created successfully!');
            $this->redirect(route('admin.users.edit', $user->id), navigate: true);
        }
    }

    public function confirmDelete(): void
    {
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if (!$this->user) {
            return;
        }

        // Prevent deleting yourself
        if ($this->user->id === auth()->id()) {
            session()->flash('error', 'You cannot delete your own account.');
            $this->showDeleteModal = false;
            return;
        }

        // Prevent deleting super admin
        if ($this->user->role === UserRole::SUPER_ADMIN) {
            session()->flash('error', 'Super admin account cannot be deleted.');
            $this->showDeleteModal = false;
            return;
        }

        ActivityLog::log('delete', $this->user, 'Deleted user: ' . $this->user->name);
        $this->user->delete();

        session()->flash('success', 'User deleted successfully!');
        $this->redirect(route('admin.users.index'), navigate: true);
    }

    public function render()
    {
        return view('admin.livewire.users.user-editor', [
            'roles' => UserRole::cases(),
        ])->layout('admin.layouts.app');
    }
}
