<?php

namespace App\Livewire\Frontend;

use App\Enums\ContactStatus;
use App\Models\Contact;
use Livewire\Component;

class NewsletterForm extends Component
{
    public string $email = '';
    public bool $subscribed = false;

    protected array $rules = [
        'email' => 'required|email|max:100',
    ];

    public function subscribe(): void
    {
        $this->validate();

        Contact::updateOrCreate(
            ['email' => $this->email],
            [
                'name' => 'Newsletter Subscriber',
                'source' => 'newsletter',
                'status' => ContactStatus::NEW,
            ]
        );

        $this->subscribed = true;
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.frontend.newsletter-form');
    }
}
