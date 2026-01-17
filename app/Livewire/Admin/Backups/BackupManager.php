<?php

namespace App\Livewire\Admin\Backups;

use App\Enums\BackupStatus;
use App\Enums\BackupType;
use App\Models\Backup;
use App\Services\Admin\BackupService;
use Livewire\Component;
use Livewire\WithPagination;

class BackupManager extends Component
{
    use WithPagination;

    public bool $creating = false;

    public function createBackup(string $type): void
    {
        $this->creating = true;

        try {
            $backupService = app(BackupService::class);
            $backup = $backupService->create(BackupType::from($type), auth()->user());
            session()->flash('success', 'Backup created successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create backup: ' . $e->getMessage());
        }

        $this->creating = false;
    }

    public function downloadBackup(int $id): mixed
    {
        $backup = Backup::findOrFail($id);

        if ($backup->status !== BackupStatus::COMPLETED) {
            session()->flash('error', 'This backup is not ready for download.');
            return null;
        }

        return response()->download(storage_path('app/' . $backup->path));
    }

    public function deleteBackup(int $id): void
    {
        $backup = Backup::findOrFail($id);
        $backupService = app(BackupService::class);
        $backupService->delete($backup);
        session()->flash('success', 'Backup deleted successfully!');
    }

    public function render()
    {
        $backups = Backup::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.livewire.backups.backup-manager', [
            'backups' => $backups,
            'types' => BackupType::cases(),
        ])->layout('admin.layouts.app');
    }
}
