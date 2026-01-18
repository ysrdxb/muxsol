@php
    $items = $content['items'] ?? [];
    
    $defaultServices = [
        ['icon' => 'bi-code-slash', 'title' => 'Web Systems', 'description' => 'Enterprise web applications built for scale and performance.', 'id' => 'SVC-01'],
        ['icon' => 'bi-phone', 'title' => 'Mobile Apps', 'description' => 'Native and cross-platform solutions for iOS and Android.', 'id' => 'SVC-02'],
        ['icon' => 'bi-cpu', 'title' => 'AI Integration', 'description' => 'Machine learning models and intelligent automation pipelines.', 'id' => 'SVC-03'],
        ['icon' => 'bi-cloud', 'title' => 'Cloud Infra', 'description' => 'Scalable cloud architecture on AWS, GCP, and Azure.', 'id' => 'SVC-04'],
        ['icon' => 'bi-database', 'title' => 'Data Systems', 'description' => 'Data pipelines, analytics dashboards, and BI solutions.', 'id' => 'SVC-05'],
        ['icon' => 'bi-gear', 'title' => 'API Layer', 'description' => 'RESTful and GraphQL APIs for seamless integrations.', 'id' => 'SVC-06']
    ];
    
    $services = count($items) > 0 ? $items : $defaultServices;
@endphp

<!-- Services Section - Midnight -->
<section id="services" class="section-midnight section-padding">
    <div class="container">
        <!-- Header -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center">
                <div class="mono-label mb-3">[ SERVICES // CAPABILITIES ]</div>
                <h2 class="display-5 fw-bold text-white mb-4">
                    System <span class="text-gradient">Modules</span>
                </h2>
                <p class="lead" style="color: var(--text-muted);">
                    Full-stack engineering capabilities for modern enterprises.
                </p>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="row g-4">
            @foreach($services as $index => $service)
                @php
                    $icon = $service['icon'] ?? 'bi-star';
                    $title = $service['title'] ?? 'Service';
                    $description = $service['description'] ?? 'Description';
                    $id = $service['id'] ?? 'SVC-0'.($index+1);
                    $isGreen = $index % 2 === 1;
                    $cardClass = $isGreen ? 'card-retro-green' : 'card-retro';
                    $accentColor = $isGreen ? 'var(--neon-green)' : 'var(--neon-blue)';
                @endphp
                
                <div class="col-md-6 col-lg-4">
                    <div class="{{ $cardClass }} h-100 p-4">
                        <span class="serial-tag">[ {{ $id }} ]</span>
                        
                        <!-- Icon with Industrial Glow -->
                        <div class="d-flex align-items-center justify-content-center mb-4" 
                             style="width: 64px; height: 64px; border: 1px solid {{ $accentColor }}; background: rgba(0,0,0,0.2); box-shadow: 0 0 15px {{ $accentColor }}33;">
                            <i class="bi {{ $icon }}" style="font-size: 1.75rem; color: {{ $accentColor }}; text-shadow: 0 0 10px {{ $accentColor }}66;"></i>
                        </div>

                        <!-- Title -->
                        <h5 class="text-white fw-bold mb-3" style="text-transform: uppercase; letter-spacing: 0.08em; font-family: var(--font-mono);">
                            {{ $title }}
                        </h5>

                        <!-- Description -->
                        <p class="mb-4" style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.7;">
                            {{ $description }}
                        </p>

                        <!-- Link -->
                        <a href="#" class="text-decoration-none d-inline-flex align-items-center gap-2" 
                           style="color: {{ $accentColor }}; font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.1em;">
                            LEARN MORE →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
