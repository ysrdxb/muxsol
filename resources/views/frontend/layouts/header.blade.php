@php
    $siteName = \App\Models\Setting::get('general.site_name', config('app.name'));
    $menuItems = [
        ['label' => 'HOME', 'url' => url('/')],
        ['label' => 'ABOUT', 'url' => '#about'],
        ['label' => 'SERVICES', 'url' => '#services'],
        ['label' => 'WORK', 'url' => '#portfolio'],
        ['label' => 'CONTACT', 'url' => '#contact'],
    ];
@endphp

<!-- Industrial Header - solid #08101d on scroll or clean industrial -->
<nav class="navbar navbar-expand-lg fixed-top main-header" style="background: #08101d; border-bottom: 1px solid rgba(255,255,255,0.05); padding: 15px 0; transition: all 0.3s ease;">
    <div class="container">
        <!-- Logo - Dot Matrix Technique (Increased Size) -->
        <a class="logo-dot-matrix" href="{{ url('/') }}" style="font-size: 1.8rem; letter-spacing: 0.1em;">
            <span class="mux">MUX</span><span class="sol">SOL</span>
        </a>

        <!-- Mobile Toggle - Terminal Style -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="padding: 5px;">
            <div class="toggler-icon-wrap">
                <span class="tty-label" style="font-size: 9px; color: var(--neon-blue); margin-right: 8px; font-family: var(--font-mono);">MENU_</span>
                <i class="bi bi-grid-fill" style="color: white; font-size: 1.25rem;"></i>
            </div>
        </button>

        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-4 gap-1">
                @foreach($menuItems as $item)
                    <li class="nav-item">
                        <a class="nav-link px-3" href="{{ $item['url'] }}" 
                           style="font-family: var(--font-mono); font-size: 10.5px; font-weight: 700; letter-spacing: 0.15em; color: #94A3B8; transition: all 0.2s;">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- CTA - Vintage Style -->
            <a href="#contact" class="btn-physical-click d-none d-lg-inline-block" style="padding: 10px 24px; font-size: 10px;">
                INIT_PROJECT_
            </a>
        </div>
    </div>
</nav>

<style>
    .nav-link:hover {
        color: var(--neon-blue) !important;
        text-shadow: 0 0 10px rgba(0, 107, 255, 0.3);
    }

    .toggler-icon-wrap {
        display: flex;
        align-items: center;
        border: 1px solid rgba(255,255,255,0.1);
        padding: 5px 12px;
        background: rgba(255,255,255,0.03);
    }

    @media (max-width: 991.98px) {
        #navbarNav {
            background: #08101d;
            margin-top: 15px;
            border: 2px solid #1E293B;
            padding: 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            position: relative;
        }

        /* Mobile Menu Decorative Elements */
        #navbarNav::before {
            content: "SYSTEM_ACCESS_v2.0";
            position: absolute;
            top: -12px;
            left: 20px;
            background: #1E293B;
            color: #64748B;
            font-family: var(--font-mono);
            font-size: 8px;
            padding: 2px 10px;
            letter-spacing: 0.1em;
        }

        .navbar-nav .nav-link {
            padding: 15px 0 !important;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            font-size: 12px !important;
        }

        .navbar-nav .nav-link:last-child {
            border-bottom: none;
        }
    }
</style>
