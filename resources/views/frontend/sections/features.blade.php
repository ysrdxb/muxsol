@php
    $defaultProducts = [
        ['title' => 'Enterprise SaaS', 'description' => 'Multi-tenant platforms built for scale.', 'tag' => 'PLATFORM', 'icon' => 'bi-hdd-stack', 'id' => 'PRD-01'],
        ['title' => 'AI Automation', 'description' => 'Intelligent workflow automation systems.', 'tag' => 'AI/ML', 'icon' => 'bi-cpu', 'id' => 'PRD-02'],
        ['title' => 'Analytics Engine', 'description' => 'Real-time data visualization dashboards.', 'tag' => 'DATA', 'icon' => 'bi-graph-up', 'id' => 'PRD-03']
    ];
    $items = count($content['items'] ?? []) > 0 ? $content['items'] : $defaultProducts;
@endphp

<!-- Products Section - Onyx -->
<section id="products" class="section-onyx section-padding">
    <div class="container">
        <!-- Header -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center">
                <div class="mono-label mb-3">[ PRODUCTS // SOLUTIONS ]</div>
                <h2 class="display-5 fw-bold text-white mb-4">
                    Core <span class="text-gradient">Products</span>
                </h2>
                <p class="lead" style="color: var(--text-muted);">
                    Enterprise-grade systems engineered for performance.
                </p>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            @foreach($items as $index => $item)
                @php
                    $title = $item['title'] ?? 'Product';
                    $description = $item['description'] ?? 'Description';
                    $tag = $item['tag'] ?? 'MODULE';
                    $icon = $item['icon'] ?? 'bi-box';
                    $id = $item['id'] ?? 'PRD-0'.($index+1);
                    $isGreen = $index % 2 === 1;
                    $cardClass = $isGreen ? 'card-retro-green' : 'card-retro';
                    $accentColor = $isGreen ? 'var(--neon-green)' : 'var(--neon-blue)';
                @endphp
                
                <div class="col-md-6 col-lg-4">
                    <div class="{{ $cardClass }} h-100">
                        <span class="serial-tag">[ {{ $id }} ]</span>
                        
                        <!-- Visual Header -->
                        <div class="p-4 text-center" style="background: rgba(255,255,255,0.02); border-bottom: 1px solid var(--border-dark);">
                            <i class="{{ $icon }}" style="font-size: 2.5rem; color: {{ $accentColor }};"></i>
                        </div>

                        <!-- Content -->
                        <div class="p-4">
                            <div class="mono-label mb-2" style="color: {{ $accentColor }};">{{ $tag }}</div>
                            
                            <h5 class="text-white fw-bold mb-3" style="text-transform: uppercase;">
                                {{ $title }}
                            </h5>
                            
                            <p class="mb-4" style="color: var(--text-muted); font-size: 0.9rem;">
                                {{ $description }}
                            </p>

                            <a href="#" class="text-decoration-none d-inline-flex align-items-center gap-2" 
                               style="color: {{ $accentColor }}; font-family: var(--font-mono); font-size: 11px; letter-spacing: 0.1em;">
                                EXPLORE MODULE →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
