@php
    $items = $content['items'] ?? [];
    $style = $settings['style'] ?? 'grid';
    $caseStudyUrl = $content['case_study_url'] ?? '';
    $caseStudyButtonText = $content['case_study_button_text'] ?? 'Read case study';

    // Default testimonials if none provided
    $defaultItems = [
        [
            'name' => 'Sarah Johnson',
            'title' => 'CTO at TechVenture',
            'quote' => 'MuxSol transformed our entire tech stack. Their AI integration saved us 40% in operational costs and their team was exceptional throughout.',
            'rating' => 5,
            'image' => null
        ],
        [
            'name' => 'Michael Chen',
            'title' => 'Founder of FinFlow',
            'quote' => 'The mobile app they built for us exceeded all expectations. Clean code, beautiful UI, and delivered on time. Highly recommended!',
            'rating' => 5,
            'image' => null
        ],
        [
            'name' => 'Emma Williams',
            'title' => 'Product Manager at HealthFirst',
            'quote' => "Working with MuxSol felt like having an extended team. They understood our vision and brought it to life with pixel-perfect precision.",
            'rating' => 5,
            'image' => null
        ]
    ];

    $displayItems = count($items) > 0 ? $items : $defaultItems;
@endphp

<!-- Testimonials Section - Modern Dark Theme -->
<section class="testimonials-v2 section-py relative overflow-hidden" style="background: linear-gradient(180deg, #080B1A 0%, #0A0E27 50%, #0D1229 100%);">
    <!-- Background Effects -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-purple/5 rounded-full blur-[150px]"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-brand-cyan/5 rounded-full blur-[120px]"></div>
    </div>

    <div class="container-custom relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-20 scroll-reveal">
            <span class="text-brand-purple font-black tracking-[0.3em] uppercase text-xs mb-4 block">Testimonials</span>
            <h2 class="text-5xl lg:text-6xl font-bold text-white mb-6">
                What Our <span class="text-gradient">Clients</span> Say
            </h2>
            <p class="text-gray-400 max-w-2xl mx-auto text-lg leading-relaxed">
                Don't just take our word for it. Here's what industry leaders have to say about working with MUXSOL.
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($displayItems as $index => $item)
                @php
                    $colors = ['cyan', 'purple', 'green'];
                    $color = $colors[$index % 3];
                    $borderColors = [
                        'cyan' => 'border-brand-cyan/20 hover:border-brand-cyan/40',
                        'purple' => 'border-brand-purple/20 hover:border-brand-purple/40',
                        'green' => 'border-brand-green/20 hover:border-brand-green/40'
                    ];
                    $textColors = [
                        'cyan' => 'text-brand-cyan',
                        'purple' => 'text-brand-purple',
                        'green' => 'text-brand-green'
                    ];
                @endphp

                <div class="testimonial-card-v2 glass-effect rounded-2xl p-8 {{ $borderColors[$color] }} border transition-all duration-500 hover:bg-white/[0.03] group scroll-reveal"
                     data-delay="{{ 150 * ($index + 1) }}">

                    <!-- Quote Icon -->
                    <div class="mb-6">
                        <svg class="w-10 h-10 {{ $textColors[$color] }} opacity-50 group-hover:opacity-100 transition-opacity" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>

                    <!-- Stars -->
                    <div class="flex items-center gap-1 mb-6">
                        @for($i = 0; $i < ($item['rating'] ?? 5); $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>

                    <!-- Quote -->
                    <blockquote class="text-gray-300 text-lg leading-relaxed mb-8 min-h-[120px]">
                        "{{ $item['quote'] ?? '' }}"
                    </blockquote>

                    <!-- Author -->
                    <div class="flex items-center gap-4 pt-6 border-t border-white/10">
                        @if(isset($item['image']) && $item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] ?? '' }}"
                                 class="w-14 h-14 rounded-full object-cover border-2 border-white/10">
                        @else
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-{{ $color === 'cyan' ? 'brand-cyan' : ($color === 'purple' ? 'brand-purple' : 'brand-green') }} to-transparent flex items-center justify-center text-white font-bold text-lg border-2 border-white/10">
                                {{ strtoupper(substr($item['name'] ?? 'A', 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div class="font-bold text-white">{{ $item['name'] ?? '' }}</div>
                            @if(isset($item['title']))
                                <div class="text-sm {{ $textColors[$color] }}">{{ $item['title'] }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bottom Stats / Trust Indicators -->
        <div class="mt-20 text-center scroll-reveal">
            <div class="inline-flex flex-wrap justify-center items-center gap-8 lg:gap-16 glass-effect px-10 py-6 rounded-2xl">
                <div class="flex items-center gap-3">
                    <div class="text-4xl font-black text-gradient">4.9</div>
                    <div class="text-left">
                        <div class="flex gap-1">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <div class="text-xs text-gray-500 uppercase tracking-wider">Average Rating</div>
                    </div>
                </div>

                <div class="w-px h-12 bg-white/10 hidden lg:block"></div>

                <div class="text-center">
                    <div class="text-3xl font-black text-white">50+</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wider">Happy Clients</div>
                </div>

                <div class="w-px h-12 bg-white/10 hidden lg:block"></div>

                <div class="text-center">
                    <div class="text-3xl font-black text-white">98%</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wider">Retention Rate</div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .testimonial-card-v2 {
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .testimonial-card-v2:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

    /* Avatar gradient fallback colors */
    .from-brand-cyan { --tw-gradient-from: var(--brand-cyan); }
    .from-brand-purple { --tw-gradient-from: var(--brand-purple); }
    .from-brand-green { --tw-gradient-from: var(--brand-green); }
</style>
