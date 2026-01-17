<?php

namespace App\Livewire\Admin\Pages;

use App\Enums\PageStatus;
use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;

class PageList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public string $sortBy = 'created_at';
    public string $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function delete(int $id): void
    {
        $page = Page::findOrFail($id);
        $page->delete();

        session()->flash('success', 'Page deleted successfully!');
    }

    public function duplicate(int $id): void
    {
        $page = Page::findOrFail($id);

        $newPage = $page->replicate();
        $newPage->title = $page->title . ' (Copy)';
        $newPage->slug = null;
        $newPage->status = PageStatus::DRAFT;
        $newPage->is_homepage = false;
        $newPage->save();

        // Duplicate sections
        foreach ($page->sections as $section) {
            $newSection = $section->replicate();
            $newSection->page_id = $newPage->id;
            $newSection->save();
        }

        session()->flash('success', 'Page duplicated successfully!');
    }

    public function toggleHomepage(int $id): void
    {
        $page = Page::findOrFail($id);

        if ($page->is_homepage) {
            $page->update(['is_homepage' => false]);
        } else {
            Page::where('is_homepage', true)->update(['is_homepage' => false]);
            $page->update(['is_homepage' => true]);
        }

        session()->flash('success', 'Homepage updated successfully!');
    }

    public function render()
    {
        $pages = Page::query()
            ->with(['author', 'parent'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('slug', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(15);

        return view('admin.livewire.pages.page-list', [
            'pages' => $pages,
            'statuses' => PageStatus::options(),
        ])->layout('admin.layouts.app', ['title' => 'Pages']);
    }
}
