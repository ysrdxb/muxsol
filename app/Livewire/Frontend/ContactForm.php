<?php

namespace App\Livewire\Frontend;

use App\Enums\ContactStatus;
use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $message = '';

    public bool $submitted = false;

    protected array $rules = [
        'name' => 'required|min:2|max:100',
        'email' => 'required|email|max:100',
        'phone' => 'nullable|max:20',
        'message' => 'required|min:10|max:2000',
    ];

    public function submit(): void
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
            'source' => 'contact_form',
            'status' => ContactStatus::NEW,
        ]);

        $this->submitted = true;
        $this->reset(['name', 'email', 'phone', 'message']);
    }

    public function render()
    {
        return view('livewire.frontend.contact-form');
    }
}
