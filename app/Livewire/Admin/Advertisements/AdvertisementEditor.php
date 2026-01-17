<?php

namespace App\Livewire\Admin\Advertisements;

use App\Enums\AdPosition;
use App\Enums\AdType;
use App\Models\ActivityLog;
use App\Models\Advertisement;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdvertisementEditor extends Component
{
    use WithFileUploads;

    public ?Advertisement $advertisement = null;

    public string $name = '';
    public string $position = 'sidebar';
    public string $type = 'image';
    public string $content = '';
    public ?string $url = null;
    public ?string $start_date = null;
    public ?string $end_date = null;
    public bool $is_active = true;

    public $image;
    public ?string $currentImage = null;

    public bool $showDeleteModal = false;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'position' => 'required|in:' . implode(',', array_column(AdPosition::cases(), 'value')),
            'type' => 'required|in:' . implode(',', array_column(AdType::cases(), 'value')),
            'content' => 'required_unless:type,image',
            'url' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->advertisement = Advertisement::findOrFail($id);
            $this->name = $this->advertisement->name;
            $this->position = $this->advertisement->position->value;
            $this->type = $this->advertisement->type->value;
            $this->content = $this->advertisement->content ?? '';
            $this->url = $this->advertisement->url;
            $this->start_date = $this->advertisement->start_date?->format('Y-m-d');
            $this->end_date = $this->advertisement->end_date?->format('Y-m-d');
            $this->is_active = $this->advertisement->is_active;

            if ($this->type === 'image') {
                $this->currentImage = $this->advertisement->content;
            }
        }
    }

    public function updatedImage(): void
    {
        $this->validateOnly('image');
    }

    public function save(): void
    {
        $this->validate();

        $content = $this->content;

        // Handle image upload
        if ($this->type === 'image' && $this->image) {
            $path = $this->image->store('advertisements', 'public');
            $content = '/storage/' . $path;
        } elseif ($this->type === 'image' && $this->currentImage) {
            $content = $this->currentImage;
        }

        $data = [
            'name' => $this->name,
            'position' => AdPosition::from($this->position),
            'type' => AdType::from($this->type),
            'content' => $content,
            'url' => $this->url,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'is_active' => $this->is_active,
        ];

        if ($this->advertisement) {
            $this->advertisement->update($data);
            ActivityLog::log('update', $this->advertisement, 'Updated advertisement: ' . $this->advertisement->name);
            session()->flash('success', 'Advertisement updated successfully!');
        } else {
            $ad = Advertisement::create($data);
            ActivityLog::log('create', $ad, 'Created advertisement: ' . $ad->name);
            session()->flash('success', 'Advertisement created successfully!');
            $this->redirect(route('admin.advertisements.edit', $ad->id), navigate: true);
        }
    }

    public function removeImage(): void
    {
        $this->currentImage = null;
        $this->image = null;
    }

    public function confirmDelete(): void
    {
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if (!$this->advertisement) {
            return;
        }

        ActivityLog::log('delete', $this->advertisement, 'Deleted advertisement: ' . $this->advertisement->name);
        $this->advertisement->delete();

        session()->flash('success', 'Advertisement deleted successfully!');
        $this->redirect(route('admin.advertisements.index'), navigate: true);
    }

    public function render()
    {
        return view('admin.livewire.advertisements.advertisement-editor', [
            'positions' => AdPosition::cases(),
            'types' => AdType::cases(),
        ])->layout('admin.layouts.app');
    }
}
