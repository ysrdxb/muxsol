<?php

namespace App\Livewire\Admin\Media;

use App\Models\Media;
use App\Services\Admin\MediaService;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MediaLibrary extends Component
{
    use WithFileUploads, WithPagination;

    public $files = [];
    public string $search = '';
    public string $type = '';
    public ?Media $selectedMedia = null;
    public bool $showUploadModal = false;
    public bool $showDetailsModal = false;

    public string $altText = '';
    public string $caption = '';

    protected $listeners = ['mediaSelected'];

    public function updatedFiles(): void
    {
        $this->validate([
            'files.*' => 'file|max:10240|mimes:jpg,jpeg,png,gif,webp,svg,pdf,doc,docx,xls,xlsx,zip',
        ]);

        $mediaService = app(MediaService::class);

        foreach ($this->files as $file) {
            $mediaService->upload($file, auth()->id());
        }

        $this->files = [];
        $this->showUploadModal = false;
        session()->flash('success', 'Files uploaded successfully!');
    }

    public function selectMedia(int $id): void
    {
        $this->selectedMedia = Media::find($id);
        if ($this->selectedMedia) {
            $this->altText = $this->selectedMedia->alt_text ?? '';
            $this->caption = $this->selectedMedia->caption ?? '';
            $this->showDetailsModal = true;
        }
    }

    public function updateMedia(): void
    {
        if ($this->selectedMedia) {
            $this->selectedMedia->update([
                'alt_text' => $this->altText,
                'caption' => $this->caption,
            ]);
            session()->flash('success', 'Media updated successfully!');
            $this->showDetailsModal = false;
        }
    }

    public function deleteMedia(): void
    {
        if ($this->selectedMedia) {
            $mediaService = app(MediaService::class);
            $mediaService->delete($this->selectedMedia);
            $this->selectedMedia = null;
            $this->showDetailsModal = false;
            session()->flash('success', 'Media deleted successfully!');
        }
    }

    public function render()
    {
        $query = Media::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->type === 'images', fn($q) => $q->where('mime_type', 'like', 'image/%'))
            ->when($this->type === 'documents', fn($q) => $q->where('mime_type', 'not like', 'image/%'))
            ->orderBy('created_at', 'desc');

        return view('admin.livewire.media.media-library', [
            'media' => $query->paginate(24),
        ])->layout('admin.layouts.app');
    }
}
