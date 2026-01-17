<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Contacts</h1>
        <p class="mt-1 text-sm text-gray-500">Manage leads and contact form submissions</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-lg bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-200 p-4">
            <div class="flex items-center space-x-4">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search contacts..."
                       class="w-64 rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">

                <select wire:model.live="status"
                        class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    <option value="">All Status</option>
                    @foreach($statuses as $statusOption)
                        <option value="{{ $statusOption->value }}">{{ $statusOption->label() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Source</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($contacts as $contact)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $contact->name }}</div>
                                @if($contact->phone)
                                    <div class="text-sm text-gray-500">{{ $contact->phone }}</div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $contact->email }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $contact->source }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <select wire:change="updateStatus({{ $contact->id }}, $event.target.value)"
                                        class="rounded border-gray-300 text-xs focus:border-primary focus:ring-primary
                                               {{ $contact->status === \App\Enums\ContactStatus::NEW ? 'bg-yellow-50 text-yellow-800' : '' }}
                                               {{ $contact->status === \App\Enums\ContactStatus::CONTACTED ? 'bg-blue-50 text-blue-800' : '' }}
                                               {{ $contact->status === \App\Enums\ContactStatus::QUALIFIED ? 'bg-purple-50 text-purple-800' : '' }}
                                               {{ $contact->status === \App\Enums\ContactStatus::CONVERTED ? 'bg-green-50 text-green-800' : '' }}
                                               {{ $contact->status === \App\Enums\ContactStatus::CLOSED ? 'bg-gray-50 text-gray-800' : '' }}">
                                    @foreach($statuses as $statusOption)
                                        <option value="{{ $statusOption->value }}" {{ $contact->status === $statusOption ? 'selected' : '' }}>
                                            {{ $statusOption->label() }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $contact->created_at->format('M d, Y') }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                <button wire:click="viewContact({{ $contact->id }})"
                                        class="text-primary hover:text-primary/80">View</button>
                                <button wire:click="deleteContact({{ $contact->id }})"
                                        wire:confirm="Are you sure you want to delete this contact?"
                                        class="ml-4 text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                No contacts found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($contacts->hasPages())
            <div class="border-t border-gray-200 px-4 py-3">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>

    <!-- Contact Details Modal -->
    @if($showDetailsModal && $selectedContact)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                <div wire:click="$set('showDetailsModal', false)" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="inline-block transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Contact Details</h3>
                            <button wire:click="$set('showDetailsModal', false)" class="text-gray-400 hover:text-gray-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $selectedContact->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="mailto:{{ $selectedContact->email }}" class="text-primary hover:underline">
                                        {{ $selectedContact->email }}
                                    </a>
                                </dd>
                            </div>
                            @if($selectedContact->phone)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedContact->phone }}</dd>
                                </div>
                            @endif
                            @if($selectedContact->company)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Company</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $selectedContact->company }}</dd>
                                </div>
                            @endif
                            @if($selectedContact->message)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Message</dt>
                                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $selectedContact->message }}</dd>
                                </div>
                            @endif
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Received</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $selectedContact->created_at->format('F d, Y \a\t g:i A') }}</dd>
                            </div>
                        </dl>

                        <div class="mt-6 flex justify-end">
                            <button wire:click="$set('showDetailsModal', false)"
                                    class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
