<?php

namespace App\Livewire\Admin\EmailTemplates;

use App\Models\EmailTemplate;
use Livewire\Component;
use Livewire\WithPagination;

class EmailTemplateList extends Component
{
    use WithPagination;

    public string $search = '';

    public function delete(int $id): void
    {
        EmailTemplate::findOrFail($id)->delete();
        session()->flash('success', 'Email template deleted successfully!');
    }

    public function render()
    {
        $templates = EmailTemplate::when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.livewire.email-templates.email-template-list', [
            'templates' => $templates,
        ])->layout('admin.layouts.app');
    }
}
