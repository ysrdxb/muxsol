@php
    $projects = [
        ['title' => 'Nexus ERP', 'category' => 'ENTERPRISE', 'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80', 'id' => 'PRJ-01'],
        ['title' => 'FinTech App', 'category' => 'MOBILE', 'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=600&q=80', 'id' => 'PRJ-02'],
        ['title' => 'Health Platform', 'category' => 'HEALTHCARE', 'image' => 'https://images.unsplash.com/photo-1576091160550-217359f41f18?auto=format&fit=crop&w=600&q=80', 'id' => 'PRJ-03'],
        ['title' => 'Analytics Hub', 'category' => 'DATA', 'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80', 'id' => 'PRJ-04']
    ];
    
    $items = count($content['items'] ?? []) > 0 ? $content['items'] : $projects;
@endphp

<!-- Portfolio Section - Midnight -->
<section id="portfolio" class="section-midnight section-padding">
    <div class="container">
        <!-- Header -->
        <div class="row justify-content-between align-items-end mb-5">
            <div class="col-lg-6">
                <div class="mono-label mb-3">[ PORTFOLIO // CASE STUDIES ]</div>
                <h2 class="display-5 fw-bold text-white mb-3">
                    Featured <span class="text-gradient">Systems</span>
                </h2>
                <p style="color: var(--text-muted);">
                    Production-grade solutions deployed at scale.
                </p>
            </div>
            <div class="col-lg-auto">
                <a href="#" class="btn-outline-industrial">
                    VIEW ALL PROJECTS
                </a>
            </div>
        </div>

        <!-- Portfolio Grid -->
        <div class="row g-4">
            @foreach($items as $index => $project)
                @php
                    $title = $project['title'] ?? 'Project';
                    $category = $project['category'] ?? 'SYSTEM';
                    $image = $project['image'] ?? 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80';
                    $id = $project['id'] ?? 'PRJ-0'.($index+1);
                    $colClass = ($index === 0 || $index === 3) ? 'col-md-7' : 'col-md-5';
                    $cardClass = ($index % 2 === 0) ? 'card-retro' : 'card-retro-green';
                @endphp
                
                <div class="{{ $colClass }}">
                    <div class="{{ $cardClass }} position-relative overflow-hidden" style="height: {{ $index === 0 || $index === 3 ? '320px' : '280px' }};">
                        <span class="serial-tag" style="z-index: 20;">[ {{ $id }} ]</span>
                        
                        <img src="{{ $image }}" alt="{{ $title }}" class="w-100 h-100" 
                             style="object-fit: cover; filter: grayscale(40%); transition: all 0.4s ease;">
                        
                        <!-- Overlay -->
                        <div class="position-absolute w-100 h-100 d-flex flex-column justify-content-end p-4" 
                             style="top: 0; left: 0; background: linear-gradient(to top, rgba(5,11,22,0.95) 0%, rgba(5,11,22,0.3) 50%, transparent 100%);">
                            
                            <div class="mono-label mb-2" style="color: var(--neon-cyan);">{{ $category }}</div>
                            <h5 class="text-white fw-bold mb-0" style="text-transform: uppercase;">{{ $title }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    #portfolio .card-retro:hover img {
        filter: grayscale(0%);
        transform: scale(1.05);
    }
</style>
