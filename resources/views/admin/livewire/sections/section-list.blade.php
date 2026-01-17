<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Sections</h1>
        <p class="mt-1 text-sm text-gray-500">View all sections across your pages</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-lg bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-gray-200 p-4">
            <div class="flex items-center space-x-4">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search sections..."
                       class="w-64 rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">

                <select wire:model.live="type"
                        class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    <option value="">All Types</option>
                    @foreach($sectionTypes as $sectionType)
                        <option value="{{ $sectionType->value }}">{{ $sectionType->label() }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Page</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($sections as $section)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $section->title ?: 'Untitled' }}</div>
                                @if($section->subtitle)
                                    <div class="text-sm text-gray-500">{{ Str::limit($section->subtitle, 50) }}</div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <span class="inline-flex rounded-full bg-primary/10 px-2 py-0.5 text-xs font-medium text-primary">
                                    {{ $section->type->label() }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                @if($section->page)
                                    <a href="{{ route('admin.pages.edit', $section->page->id) }}" class="text-primary hover:underline">
                                        {{ $section->page->title }}
                                    </a>
                                @else
                                    <span class="text-gray-400">No page</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">
                                @if($section->is_active)
                                    <span class="inline-flex rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-800">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-right">
                                @if($section->page)
                                    <a href="{{ route('admin.pages.edit', $section->page->id) }}"
                                       class="text-primary hover:text-primary/80">Edit Page</a>
                                @endif
                                <button wire:click="deleteSection({{ $section->id }})"
                                        wire:confirm="Are you sure you want to delete this section?"
                                        class="ml-4 text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                No sections found. Create sections by editing pages.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($sections->hasPages())
            <div class="border-t border-gray-200 px-4 py-3">
                {{ $sections->links() }}
            </div>
        @endif
    </div>
</div>
