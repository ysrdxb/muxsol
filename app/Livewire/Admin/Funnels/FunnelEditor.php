<?php

namespace App\Livewire\Admin\Funnels;

use App\Models\Funnel;
use Illuminate\Support\Str;
use Livewire\Component;

class FunnelEditor extends Component
{
    public ?Funnel $funnel = null;
    public string $name = '';
    public string $slug = '';
    public string $description = '';
    public bool $is_active = true;

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->funnel = Funnel::findOrFail($id);
            $this->name = $this->funnel->name;
            $this->slug = $this->funnel->slug;
            $this->description = $this->funnel->description ?? '';
            $this->is_active = $this->funnel->is_active;
        }
    }

    public function updatedName(): void
    {
        if (!$this->funnel) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|min:2|max:255',
            'slug' => 'required|max:255',
        ]);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'is_active' => $this->is_active,
        ];

        if ($this->funnel) {
            $this->funnel->update($data);
        } else {
            $this->funnel = Funnel::create($data);
        }

        session()->flash('success', 'Funnel saved successfully!');
    }

    public function render()
    {
        return view('admin.livewire.funnels.funnel-editor')->layout('admin.layouts.app');
    }
}
