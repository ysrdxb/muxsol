<?php

namespace App\Livewire\Admin\Sections;

use App\Enums\SectionType;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class SectionList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $type = '';

    public function deleteSection(int $id): void
    {
        Section::findOrFail($id)->delete();
        session()->flash('success', 'Section deleted successfully!');
    }

    public function render()
    {
        $sections = Section::with('page')
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->type, fn($q) => $q->where('type', $this->type))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.livewire.sections.section-list', [
            'sections' => $sections,
            'sectionTypes' => SectionType::cases(),
        ])->layout('admin.layouts.app');
    }
}
