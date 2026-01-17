<?php

namespace App\Livewire\Admin\Pages;

use App\Enums\PageStatus;
use App\Enums\SectionType;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Support\Str;
use Livewire\Component;

class PageEditor extends Component
{
    public ?Page $page = null;

    public string $title = '';
    public string $slug = '';
    public string $content = '';
    public string $excerpt = '';
    public string $template = 'default';
    public string $status = 'draft';
    public ?string $featured_image = null;

    public array $sections = [];
    public bool $showSectionModal = false;
    public ?int $editingSectionIndex = null;
    public array $sectionForm = [];

    protected array $rules = [
        'title' => 'required|min:2|max:255',
        'slug' => 'required|max:255',
        'content' => 'nullable',
        'excerpt' => 'nullable|max:500',
        'template' => 'required',
        'status' => 'required',
    ];

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->page = Page::with('sections')->findOrFail($id);
            $this->title = $this->page->title;
            $this->slug = $this->page->slug;
            $this->content = $this->page->content ?? '';
            $this->excerpt = $this->page->excerpt ?? '';
            $this->template = $this->page->template ?? 'default';
            $this->status = $this->page->status->value;
            $this->featured_image = $this->page->featured_image;
            $this->sections = $this->page->sections->map(fn($s) => [
                'id' => $s->id,
                'type' => $s->type->value,
                'title' => $s->title,
                'subtitle' => $s->subtitle,
                'content' => $s->content,
                'settings' => $s->settings,
                'is_active' => $s->is_active,
            ])->toArray();
        }
    }

    public function updatedTitle(): void
    {
        if (!$this->page) {
            $this->slug = Str::slug($this->title);
        }
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'template' => $this->template,
            'status' => PageStatus::from($this->status),
            'featured_image' => $this->featured_image,
            'author_id' => auth()->id(),
        ];

        if ($this->status === 'published' && (!$this->page || $this->page->status !== PageStatus::PUBLISHED)) {
            $data['published_at'] = now();
        }

        if ($this->page) {
            $this->page->update($data);
        } else {
            $this->page = Page::create($data);
        }

        // Save sections
        $existingSectionIds = [];
        foreach ($this->sections as $index => $sectionData) {
            $sectionData['page_id'] = $this->page->id;
            $sectionData['type'] = SectionType::from($sectionData['type']);
            $sectionData['order'] = $index + 1;

            if (isset($sectionData['id'])) {
                $section = Section::find($sectionData['id']);
                if ($section) {
                    $section->update($sectionData);
                    $existingSectionIds[] = $section->id;
                }
            } else {
                $section = Section::create($sectionData);
                $this->sections[$index]['id'] = $section->id;
                $existingSectionIds[] = $section->id;
            }
        }

        // Delete removed sections
        Section::where('page_id', $this->page->id)
            ->whereNotIn('id', $existingSectionIds)
            ->delete();

        session()->flash('success', 'Page saved successfully!');

        if (!request()->routeIs('admin.pages.edit')) {
            $this->redirect(route('admin.pages.edit', $this->page->id), navigate: true);
        }
    }

    public function addSection(string $type): void
    {
        $sectionType = SectionType::from($type);
        $this->sections[] = [
            'type' => $type,
            'title' => '',
            'subtitle' => '',
            'content' => $sectionType->defaultContent(),
            'settings' => $sectionType->defaultSettings(),
            'is_active' => true,
        ];
        $this->showSectionModal = false;
    }

    public function editSection(int $index): void
    {
        $this->editingSectionIndex = $index;
        $this->sectionForm = $this->sections[$index];
    }

    public function updateSection(): void
    {
        if ($this->editingSectionIndex !== null) {
            $this->sections[$this->editingSectionIndex] = $this->sectionForm;
            $this->editingSectionIndex = null;
            $this->sectionForm = [];
        }
    }

    public function removeSection(int $index): void
    {
        unset($this->sections[$index]);
        $this->sections = array_values($this->sections);
    }

    public function moveSection(int $index, string $direction): void
    {
        $newIndex = $direction === 'up' ? $index - 1 : $index + 1;
        if ($newIndex >= 0 && $newIndex < count($this->sections)) {
            $temp = $this->sections[$index];
            $this->sections[$index] = $this->sections[$newIndex];
            $this->sections[$newIndex] = $temp;
        }
    }

    public function toggleSection(int $index): void
    {
        $this->sections[$index]['is_active'] = !$this->sections[$index]['is_active'];
    }

    public function render()
    {
        return view('admin.livewire.pages.page-editor', [
            'sectionTypes' => SectionType::cases(),
            'statusOptions' => PageStatus::cases(),
        ])->layout('admin.layouts.app');
    }
}
