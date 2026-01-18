@php
    $title = $content['title'] ?? 'About System';
    $description = $content['description'] ?? 'We architect digital solutions that scale with your ambitions.';
@endphp

<!-- About Section - Onyx -->
<section id="about" class="section-onyx section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            
            <!-- Left: Visual -->
            <div class="col-lg-6">
                <div class="card-retro p-0 overflow-hidden" style="height: 400px;">
                    <span class="serial-tag">[ SYS-CORE ]</span>
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=700&q=80" 
                         alt="Team" 
                         class="w-100 h-100" 
                         style="object-fit: cover; filter: grayscale(30%);">
                </div>
            </div>

            <!-- Right: Content -->
            <div class="col-lg-6">
                <div class="mono-label mb-3">[ ABOUT // MUXSOL ]</div>
                
                <h2 class="display-5 fw-bold text-white mb-4">
                    Engineering <span class="text-gradient">Digital Excellence</span>
                </h2>
                
                <p class="lead mb-4" style="color: var(--text-muted); line-height: 1.8;">
                    {{ $description }}
                </p>

                <p class="mb-5" style="color: var(--text-muted);">
                    We combine strategic thinking with technical precision to build systems that matter.
                </p>

                <!-- Metrics -->
                <div class="row g-4 mb-4">
                    <div class="col-6">
                        <div class="card-retro p-4" style="box-shadow: 4px 4px 0 0 var(--neon-cyan);">
                            <span class="serial-tag">[ M-01 ]</span>
                            <div class="mono-label mb-2">DELIVERY</div>
                            <h4 class="text-white fw-bold mb-0">98%</h4>
                            <small style="color: var(--text-muted);">On-time rate</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card-retro p-4" style="box-shadow: 4px 4px 0 0 var(--neon-green);">
                            <span class="serial-tag">[ M-02 ]</span>
                            <div class="mono-label mb-2">RETENTION</div>
                            <h4 class="text-white fw-bold mb-0">95%</h4>
                            <small style="color: var(--text-muted);">Client return</small>
                        </div>
                    </div>
                </div>

                <a href="#contact" class="btn-industrial">
                    CONNECT WITH US →
                </a>
            </div>
        </div>
    </div>
</section>
