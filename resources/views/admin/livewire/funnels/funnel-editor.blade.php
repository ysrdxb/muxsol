<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $funnel ? 'Edit Funnel' : 'Create Funnel' }}</h1>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.funnels.index') }}" wire:navigate class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
            <button wire:click="save" class="rounded-lg bg-primary px-4 py-2 text-sm font-medium text-white hover:bg-primary/90">Save</button>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="rounded-lg bg-white p-6 shadow-sm">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model.live="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Slug</label>
                <div class="mt-1 flex rounded-lg shadow-sm">
                    <span class="inline-flex items-center rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">/f/</span>
                    <input type="text" wire:model="slug" class="block w-full rounded-r-lg border-gray-300 focus:border-primary focus:ring-primary">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model="description" rows="2" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"></textarea>
            </div>
            <label class="flex items-center">
                <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-primary focus:ring-primary">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
        </div>
    </div>
</div>
