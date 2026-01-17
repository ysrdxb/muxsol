<div>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $template ? 'Edit Email Template' : 'Create Email Template' }}</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $template ? 'Update email template content and settings' : 'Create a new email template' }}</p>
        </div>
        <a href="{{ route('admin.email-templates.index') }}" wire:navigate class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
            </svg>
            Back to Templates
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-md bg-green-50 p-4">
            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
                    <div class="p-6">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Template Details</h3>

                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                            <!-- Name -->
                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Template Name</label>
                                <div class="mt-2">
                                    <input type="text" wire:model.live="name" id="name"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('name') ring-red-300 @enderror"
                                           placeholder="e.g., Welcome Email">
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="sm:col-span-3">
                                <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="slug" id="slug"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('slug') ring-red-300 @enderror"
                                           placeholder="welcome-email">
                                </div>
                                @error('slug')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Subject -->
                            <div class="sm:col-span-6">
                                <label for="subject" class="block text-sm font-medium leading-6 text-gray-900">Email Subject</label>
                                <div class="mt-2">
                                    <input type="text" wire:model="subject" id="subject"
                                           class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 @error('subject') ring-red-300 @enderror"
                                           placeholder="Welcome to {{ config('app.name') }}, {{ '{{ $name }}' }}!">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">You can use variables in the subject line.</p>
                                @error('subject')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Body -->
                            <div class="sm:col-span-6">
                                <div class="flex items-center justify-between mb-2">
                                    <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Email Body (HTML)</label>
                                    <button type="button" wire:click="togglePreview"
                                            class="text-sm text-blue-600 hover:text-blue-800">
                                        {{ $showPreview ? 'Hide Preview' : 'Show Preview' }}
                                    </button>
                                </div>

                                @if($showPreview)
                                    <div class="rounded-lg border border-gray-200 bg-white p-4 mb-4">
                                        <div class="prose prose-sm max-w-none">
                                            {!! $previewContent !!}
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-2">
                                    <textarea wire:model="body" id="body" rows="15"
                                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6 font-mono @error('body') ring-red-300 @enderror"
                                              placeholder="<html>...</html>"></textarea>
                                </div>
                                @error('body')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Settings -->
                <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
                    <div class="p-6">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Settings</h3>

                        <div class="mt-6 space-y-4">
                            <!-- Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Type</label>
                                <select wire:model="type" id="type"
                                        class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    @foreach($types as $t)
                                        <option value="{{ $t->value }}">{{ $t->label() }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Active Status -->
                            <div class="flex items-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model="is_active" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-900">Active</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Variables -->
                <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
                    <div class="p-6">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Variables</h3>
                        <p class="mt-1 text-sm text-gray-500">Click a variable to copy to clipboard.</p>

                        <div class="mt-4 flex gap-2">
                            <input type="text" wire:model="newVariable" wire:keydown.enter.prevent="addVariable"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"
                                   placeholder="new_variable">
                            <button type="button" wire:click="addVariable"
                                    class="rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                                Add
                            </button>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach($variables as $index => $variable)
                                <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1 text-sm text-blue-700">
                                    <button type="button" onclick="navigator.clipboard.writeText('{{ '{{ $' . $variable . ' }}' }}')"
                                            class="hover:underline" title="Click to copy">
                                        {{ '{{ $' . $variable . ' }}' }}
                                    </button>
                                    <button type="button" wire:click="removeVariable({{ $index }})"
                                            class="text-blue-400 hover:text-blue-600">
                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick Insert -->
                <div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5">
                    <div class="p-6">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Quick HTML Snippets</h3>
                        <div class="mt-4 space-y-2">
                            <button type="button" onclick="navigator.clipboard.writeText('<h1>Title</h1>')"
                                    class="w-full text-left rounded-md bg-gray-50 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Heading - &lt;h1&gt;
                            </button>
                            <button type="button" onclick="navigator.clipboard.writeText('<p>Paragraph text</p>')"
                                    class="w-full text-left rounded-md bg-gray-50 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Paragraph - &lt;p&gt;
                            </button>
                            <button type="button" onclick="navigator.clipboard.writeText('<a href=&quot;#&quot;>Link</a>')"
                                    class="w-full text-left rounded-md bg-gray-50 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Link - &lt;a&gt;
                            </button>
                            <button type="button" onclick="navigator.clipboard.writeText('<button style=&quot;background:#3b82f6;color:white;padding:10px 20px;border:none;border-radius:5px;&quot;>Button</button>')"
                                    class="w-full text-left rounded-md bg-gray-50 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Button
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.email-templates.index') }}" wire:navigate
               class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit"
                    class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
                {{ $template ? 'Update Template' : 'Create Template' }}
            </button>
        </div>
    </form>
</div>
