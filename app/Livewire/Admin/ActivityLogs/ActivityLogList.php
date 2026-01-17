<?php

namespace App\Livewire\Admin\ActivityLogs;

use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLogList extends Component
{
    use WithPagination;

    public string $search = '';

    public function render()
    {
        $logs = ActivityLog::with('user')
            ->when($this->search, fn($q) => $q->where('action', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%"))
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.livewire.activity-logs.activity-log-list', [
            'logs' => $logs,
        ])->layout('admin.layouts.app');
    }
}
