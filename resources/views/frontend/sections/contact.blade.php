@php
    $email = $content['email'] ?? '';
    $phone = $content['phone'] ?? '';
    $address = $content['address'] ?? '';
    $showForm = $settings['show_form'] ?? true;
@endphp

<section class="py-16 sm:py-24 bg-gray-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        @if($section->title || $section->subtitle)
            <div class="text-center max-w-3xl mx-auto mb-16">
                @if($section->subtitle)
                    <p class="text-sm font-semibold uppercase tracking-wide text-primary">
                        {{ $section->subtitle }}
                    </p>
                @endif
                @if($section->title)
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                        {{ $section->title }}
                    </h2>
                @endif
            </div>
        @endif

        <div class="grid gap-12 lg:grid-cols-2">
            <!-- Contact Info -->
            <div>
                <div class="space-y-8">
                    @if($email)
                        <div class="flex items-start">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-gray-900">Email</h3>
                                <a href="mailto:{{ $email }}" class="mt-1 text-gray-600 hover:text-primary">
                                    {{ $email }}
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($phone)
                        <div class="flex items-start">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-gray-900">Phone</h3>
                                <a href="tel:{{ $phone }}" class="mt-1 text-gray-600 hover:text-primary">
                                    {{ $phone }}
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($address)
                        <div class="flex items-start">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary/10 text-primary">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-sm font-semibold text-gray-900">Address</h3>
                                <p class="mt-1 text-gray-600">{{ $address }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Contact Form -->
            @if($showForm)
                <div class="bg-white rounded-2xl p-8 shadow-sm">
                    <livewire:frontend.contact-form />
                </div>
            @endif
        </div>
    </div>
</section>
