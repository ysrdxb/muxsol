<?php

namespace App\Livewire\Admin\Contacts;

use App\Enums\ContactStatus;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public ?Contact $selectedContact = null;
    public bool $showDetailsModal = false;

    public function viewContact(int $id): void
    {
        $this->selectedContact = Contact::find($id);
        $this->showDetailsModal = true;
    }

    public function updateStatus(int $id, string $status): void
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => ContactStatus::from($status)]);
        session()->flash('success', 'Contact status updated!');
    }

    public function deleteContact(int $id): void
    {
        Contact::findOrFail($id)->delete();
        session()->flash('success', 'Contact deleted successfully!');
    }

    public function render()
    {
        $contacts = Contact::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.livewire.contacts.contact-list', [
            'contacts' => $contacts,
            'statuses' => ContactStatus::cases(),
        ])->layout('admin.layouts.app');
    }
}
