@php
    $siteName = \App\Models\Setting::get('general.site_name', config('app.name'));
@endphp

<!-- Hero Section - Vintage Industrial Mainframe -->
<section class="hero-mainframe position-relative overflow-hidden">
    
    <!-- CRT & Terminal Grid Overlays -->
    <div class="crt-scanlines"></div>
    <div class="terminal-grid"></div>

    <!-- Hardware LED Indicators (Top Left) -->
    <div class="hardware-leds">
        <div class="led led-green blinking"></div>
        <div class="led led-yellow"></div>
        <div class="led led-red"></div>
    </div>

    <!-- HUD Coordinate Markers -->
    <div class="position-absolute top-0 end-0 p-4 mono-label hud-text" style="z-index: 50; opacity: 0.3;">
        [ POS_IDX: 64.126 / 21.817 ]
    </div>

    <div class="container position-relative py-5" style="z-index: 30; margin-top: 60px;">
        <div class="row align-items-center">
            
            <!-- Left Side: Control & Logic -->
            <div class="col-lg-7">
                
                <!-- Status Bracket -->
                <div class="mono-label mb-4" style="color: var(--neon-blue); font-size: 11px; letter-spacing: 0.2em;">
                    [ SYSTEM_STATUS: INITIALIZING_CORE ]
                </div>

                <!-- Main Industrial Headline -->
                <div class="mb-4">
                    <h1 class="display-2 fw-black text-white m-0" style="letter-spacing: -0.04em; line-height: 0.9;">
                        WE <span class="action-glitch-box">BUILD</span>
                    </h1>
                </div>

                <!-- Rotating Sub-text -->
                <div class="typewriter-container mb-5">
                    <h2 class="mono-text" style="color: var(--text-muted); font-size: 1.5rem; letter-spacing: 0.05em; text-transform: uppercase;">
                        [ <span id="target-phrase">DIGITAL SYSTEMS</span> ]<span class="terminal-block-cursor"></span>
                    </h2>
                </div>

                <!-- Heavy Description -->
                <p class="mb-5 industrial-desc">
                    Architecting high-performance digital ecosystems. We engineer scalable software, AI automation, and enterprise solutions for the modern industrial age.
                </p>

                <!-- Physical Buttons -->
                <div class="d-flex flex-wrap gap-4 mt-2">
                    <a href="#contact" class="btn-physical-click">
                        INIT_PROJECT
                    </a>
                    <a href="#portfolio" class="btn-physical-click-outline">
                        VIEW_SYSTEMS
                    </a>
                </div>
            </div>

            <!-- Right Side: Data-Visualization HUD -->
            <div class="col-lg-5 mt-5 mt-lg-0">
                <div class="hud-dashboard">
                    
                    <!-- Box 1: Scrolling Code Log -->
                    <div class="hud-box">
                        <div class="hud-box-header">LOGS.EXE</div>
                        <div class="hud-box-content code-scroll-wrap">
                            <div class="scrolling-code">
                                > INITIALIZING_KERNEL...<br>
                                > LOADING_SYSTEM_RESOURCES...<br>
                                > CONNECTING_NODE_01... [OK]<br>
                                > ESTABLISHING_ENCRYPTION...<br>
                                > MUXSOL_SYSTEM_VINTAGE_CORE: v8.0.2<br>
                                > CHECKING_DATALAKES... [STABLE]<br>
                                > READY_FOR_INSTRUCTIONS_<br>
                                > BOOT_SEQ_COMPLETE<br>
                                > MONITORING_ACTIVE_CHANNELS...<br>
                                > OPTIMIZING_WORKFLOWS...
                            </div>
                        </div>
                    </div>

                    <!-- Box 2: SVG Oscilloscope -->
                    <div class="hud-box">
                        <div class="hud-box-header">OSCILLOSCOPE.SYS</div>
                        <div class="hud-box-content d-flex align-items-center justify-content-center p-0" style="height: 100px;">
                            <svg width="100%" height="60" viewBox="0 0 200 60" preserveAspectRatio="none">
                                <path d="M0 30 Q 10 10, 20 30 T 40 30 T 60 30 T 80 30 T 100 30 T 120 30 T 140 30 T 160 30 T 180 30 T 200 30" 
                                      stroke="#00FF88" stroke-width="2" fill="none" class="waveform-anim"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Box 3: Active Nodes Map -->
                    <div class="hud-box">
                        <div class="hud-box-header">NODE_MAP.NDX</div>
                        <div class="hud-box-content node-map-grid p-3">
                            <div class="dot-matrix-map">
                                <!-- Generated map dots -->
                                @for($i=0; $i<64; $i++)
                                    <div class="map-dot {{ rand(0, 10) > 8 ? 'active' : '' }}"></div>
                                @endfor
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Stats Bar -->
    <div class="position-absolute bottom-0 w-100 py-3" style="background: rgba(0,0,0,0.4); border-top: 1px solid rgba(255,255,255,0.05); z-index: 30;">
        <div class="container d-flex justify-content-between mono-text" style="font-size: 10px; color: #64748B;">
            <div>[ UPTIME: 99.98% ]</div>
            <div>[ SYS_CLOCK: {{ now()->format('H:i:s') }} ]</div>
            <div>[ REGION: EU_NORTH_01 ]</div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const targets = [
        'DIGITAL SYSTEMS',
        'AI SOLUTIONS',
        'SAAS PLATFORMS',
        'MOBILE APPS',
        'WORKFLOWS'
    ];
    
    let currentIndex = 0;
    const targetPhrase = document.getElementById('target-phrase');

    function typeEffect(element, text, callback) {
        let i = 0;
        element.textContent = '';
        const interval = setInterval(() => {
            element.textContent += text.charAt(i);
            i++;
            if (i >= text.length) {
                clearInterval(interval);
                setTimeout(callback, 2000); // Wait on screen
            }
        }, 80);
    }

    function deleteEffect(element, callback) {
        let text = element.textContent;
        const interval = setInterval(() => {
            text = text.slice(0, -1);
            element.textContent = text;
            if (text.length === 0) {
                clearInterval(interval);
                callback();
            }
        }, 50);
    }

    function rotateLoop() {
        typeEffect(targetPhrase, targets[currentIndex], () => {
            deleteEffect(targetPhrase, () => {
                currentIndex = (currentIndex + 1) % targets.length;
                rotateLoop();
            });
        });
    }

    rotateLoop();

    // Randomize Dot Map
    setInterval(() => {
        const dots = document.querySelectorAll('.map-dot');
        dots.forEach(dot => {
            if (Math.random() > 0.95) {
                dot.classList.toggle('active');
            }
        });
    }, 1000);
});
</script>

<style>
    /* 1. Mainframe Layout */
    .hero-mainframe {
        background-color: #030712;
        min-height: 100vh;
        display: flex;
        align-items: center;
        color: white;
    }

    /* CRT Scanlines Layer */
    .crt-scanlines {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.2) 50%);
        background-size: 100% 4px;
        pointer-events: none;
        z-index: 100;
        opacity: 0.15;
    }

    /* Terminal Grid Layer (+) */
    .terminal-grid {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: 
            radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
        z-index: 5;
    }

    /* 2. Redesign Headline */
    .fw-black { font-weight: 900; }
    .mono-text { font-family: 'JetBrains Mono', monospace; }

    .action-glitch-box {
        display: inline-block;
        background-color: #006BFF;
        color: white;
        padding: 4px 20px;
        margin-left: 10px;
        animation: glitch-flicker 4s infinite;
        position: relative;
    }

    @keyframes glitch-flicker {
        0%, 100% { opacity: 1; }
        92% { opacity: 1; transform: skew(0); }
        93% { opacity: 0.8; transform: skew(2deg); }
        94% { opacity: 1; transform: skew(0); }
        95% { opacity: 0.9; transform: translateX(2px); }
        96% { opacity: 1; transform: translateX(0); }
    }

    .terminal-block-cursor {
        display: inline-block;
        width: 12px;
        height: 24px;
        background-color: var(--neon-blue);
        margin-left: 8px;
        vertical-align: middle;
        animation: blink 1s step-end infinite;
    }
    @keyframes blink { 50% { opacity: 0; } }

    .industrial-desc {
        max-width: 550px;
        color: #94A3B8;
        font-size: 1.1rem;
        line-height: 1.6;
        font-family: 'JetBrains Mono', monospace;
        opacity: 0.8;
    }

    /* 3. Right-Side HUD DASHBOARD */
    .hud-dashboard {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .hud-box {
        border: 1px solid rgba(255,255,255,0.1);
        background: rgba(255,255,255,0.02);
        position: relative;
    }

    .hud-box-header {
        background: rgba(255,255,255,0.05);
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding: 4px 12px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 9px;
        color: #64748B;
        letter-spacing: 0.1em;
    }

    /* Box 1: Code Scroll */
    .code-scroll-wrap {
        height: 120px;
        overflow: hidden;
        padding: 15px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 10px;
        color: #00FF88;
        line-height: 1.5;
    }

    .scrolling-code {
        animation: scrollText 15s linear infinite;
    }

    @keyframes scrollText {
        0% { transform: translateY(0); }
        100% { transform: translateY(-100%); }
    }

    /* Box 2: Waveform */
    .waveform-anim {
        stroke-dasharray: 200;
        animation: dash 10s linear infinite;
    }
    @keyframes dash {
        to { stroke-dashoffset: -400; }
    }

    /* Box 3: Node Map */
    .dot-matrix-map {
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        gap: 8px;
        justify-items: center;
    }
    .map-dot {
        width: 4px;
        height: 4px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        transition: all 0.3s;
    }
    .map-dot.active {
        background: var(--neon-blue);
        box-shadow: 0 0 10px var(--neon-blue);
    }

    /* 4. Physical Accents */
    .hardware-leds {
        position: absolute;
        top: 20px;
        left: 20px;
        display: flex;
        gap: 8px;
        z-index: 50;
    }
    .led {
        width: 10px;
        height: 10px;
        background: #333;
    }
    .led-green { background: #28C840; box-shadow: 0 0 5px #28C840; }
    .led-yellow { background: #FEBC2E; box-shadow: 0 0 5px #FEBC2E; }
    .led-red { background: #FF5E57; box-shadow: 0 0 5px #FF5E57; }

    .blinking { animation: ledBlink 1.5s step-start infinite; }
    @keyframes ledBlink { 50% { opacity: 0.3; box-shadow: none; } }

    /* Performance Buttons */
    .btn-physical-click {
        background-color: #006BFF;
        color: white;
        padding: 14px 32px;
        text-decoration: none;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        border: none;
        box-shadow: 4px 4px 0 0 #000;
        transition: all 0.1s;
    }
    .btn-physical-click:hover {
        transform: translate(2px, 2px);
        box-shadow: 0 0 0 0 #000;
        color: white;
    }

    .btn-physical-click-outline {
        background-color: transparent;
        color: white;
        padding: 14px 32px;
        text-decoration: none;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        font-size: 12px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        border: 2px solid #1E293B;
        box-shadow: 4px 4px 0 0 #000;
        transition: all 0.1s;
    }
    .btn-physical-click-outline:hover {
        transform: translate(2px, 2px);
        box-shadow: 0 0 0 0 #000;
        border-color: #00FF88;
        color: #00FF88;
    }

    @media (max-width: 991px) {
        .display-2 { font-size: 3rem; }
        .hero-title-main { font-size: 4rem; }
    }
</style>
