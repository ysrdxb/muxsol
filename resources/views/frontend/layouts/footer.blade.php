@php
    $siteName = \App\Models\Setting::get('general.site_name', config('app.name'));
    $siteDescription = \App\Models\Setting::get('general.site_description', 'Building digital excellence.');
    $adminEmail = \App\Models\Setting::get('general.admin_email', 'hello@muxsol.com');
@endphp

<!-- Light Source Border -->
<div style="height: 1px; background: var(--border-dark);"></div>

<!-- MUXSOL Mega-Branding with Light Animation -->
<div class="mega-branding position-relative overflow-hidden" style="background: #000000; padding: 80px 0 20px;">
    
    <!-- Torch Light Beam - Expands from Center -->
    <div class="torch-light"></div>
    
    <!-- Dot-Matrix MUXSOL Text (Split for hover colors) -->
    <div class="text-center muxsol-text">
        <span class="mux-part">MUX</span><span class="sol-part">SOL</span>
    </div>
</div>

<!-- Footer - Solid Black -->
<footer style="background: #000000; border-top: 1px solid var(--border-dark); padding: 60px 0 40px;">
    <div class="container">
        <div class="row g-5 mb-5">
            <!-- Brand Column -->
            <div class="col-lg-4">
                <div style="margin-bottom: 25px;">
                    <a class="logo-dot-matrix" href="{{ url('/') }}" style="font-size: 2rem; letter-spacing: 0.1em;">
                        <span class="mux">MUX</span><span class="sol">SOL</span>
                    </a>
                </div>
                <p style="color: var(--text-muted); max-width: 280px; font-size: 0.9rem; line-height: 1.7;">
                    {{ $siteDescription }}
                </p>
                
                <!-- Social Links -->
                <div class="d-flex gap-3 mt-4">
                    <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                </div>
            </div>

            <!-- Services Column -->
            <div class="col-6 col-lg-2">
                <div class="mono-label mb-4">SERVICES</div>
                <ul class="list-unstyled">
                    <li class="mb-3"><a href="#services" class="footer-link">Web Systems</a></li>
                    <li class="mb-3"><a href="#services" class="footer-link">Mobile Apps</a></li>
                    <li class="mb-3"><a href="#services" class="footer-link">AI Integration</a></li>
                    <li class="mb-3"><a href="#services" class="footer-link">Cloud Infra</a></li>
                </ul>
            </div>

            <!-- Company Column -->
            <div class="col-6 col-lg-2">
                <div class="mono-label mb-4">COMPANY</div>
                <ul class="list-unstyled">
                    <li class="mb-3"><a href="#about" class="footer-link">About</a></li>
                    <li class="mb-3"><a href="#portfolio" class="footer-link">Work</a></li>
                    <li class="mb-3"><a href="#" class="footer-link">Careers</a></li>
                    <li class="mb-3"><a href="#contact" class="footer-link">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-lg-4">
                <div class="mono-label mb-4">CONNECT</div>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex gap-3 align-items-center">
                        <span style="color: var(--neon-cyan);">→</span>
                        <a href="mailto:{{ $adminEmail }}" class="footer-link">{{ $adminEmail }}</a>
                    </li>
                    <li class="mb-3 d-flex gap-3 align-items-center">
                        <span style="color: var(--neon-cyan);">→</span>
                        <span style="color: var(--text-muted);">Worldwide Remote</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-4 mt-4" style="border-top: 1px solid var(--border-dark);">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="mono-label">© {{ date('Y') }} {{ strtoupper($siteName) }}. ALL RIGHTS RESERVED.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="footer-link me-3" style="font-size: 11px;">PRIVACY</a>
                    <a href="#" class="footer-link" style="font-size: 11px;">TERMS</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* MUXSOL Text - Original Font with Dot-Matrix Mask */
    .muxsol-text {
        font-family: var(--font-mono);
        font-size: 22vw;
        font-weight: 900;
        line-height: 0.85;
        letter-spacing: 0.05em;
        position: relative;
        z-index: 2;
    }

    .mux-part, .sol-part {
        color: #0D1520;
        display: inline;
        transition: all 0.4s ease;
        
        /* Dot-Matrix Effect via CSS Mask */
        background: #0D1520;
        -webkit-background-clip: text;
        background-clip: text;
        mask-image: radial-gradient(circle at center, black 1.5px, transparent 1.5px);
        -webkit-mask-image: radial-gradient(circle at center, black 1.5px, transparent 1.5px);
        mask-size: 4px 4px;
        -webkit-mask-size: 4px 4px;
    }

    /* Hover Effect - MUX = Blue, SOL = Green */
    .mega-branding:hover .mux-part {
        color: #006BFF;
        background: #006BFF;
        -webkit-background-clip: text;
        background-clip: text;
        text-shadow: 
            0 0 30px rgba(0, 107, 255, 0.6),
            0 0 60px rgba(0, 107, 255, 0.3);
    }

    .mega-branding:hover .sol-part {
        color: #00FF88;
        background: #00FF88;
        -webkit-background-clip: text;
        background-clip: text;
        text-shadow: 
            0 0 30px rgba(0, 255, 136, 0.6),
            0 0 60px rgba(0, 255, 136, 0.3);
    }

    /* Torch Light - Expands from Footer Center */
    .torch-light {
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 100%;
        background: radial-gradient(
            ellipse at bottom center,
            rgba(0, 107, 255, 0.5) 0%,
            rgba(0, 107, 255, 0.3) 30%,
            rgba(0, 107, 255, 0.1) 60%,
            transparent 100%
        );
        filter: blur(50px);
        animation: torchExpand 6s ease-in-out infinite;
        z-index: 1;
    }

    /* Torch Expand Animation - Slowly expands from center outward */
    @keyframes torchExpand {
        0% {
            width: 0;
            opacity: 0;
        }
        15% {
            opacity: 0.8;
        }
        50% {
            width: 120%;
            opacity: 1;
        }
        85% {
            opacity: 0.8;
        }
        100% {
            width: 0;
            opacity: 0;
        }
    }

    /* Mobile Optimization */
    @media (max-width: 768px) {
        .muxsol-text {
            font-size: 15vw;
        }
    }

    /* Social Links */
    .social-link {
        width: 40px;
        height: 40px;
        border: 1px solid var(--border-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-muted);
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .social-link:hover {
        border-color: var(--neon-cyan);
        color: var(--neon-cyan);
    }
    
    /* Footer Links */
    .footer-link {
        color: var(--text-muted);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s ease;
    }
    .footer-link:hover {
        color: var(--neon-cyan);
    }
</style>
