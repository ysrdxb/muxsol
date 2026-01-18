@php
    $heading = $content['heading'] ?? 'Initialize Contact';
    $description = $content['description'] ?? 'Ready to build something exceptional?';
    $adminEmail = \App\Models\Setting::get('general.admin_email', 'hello@muxsol.com');
@endphp

<!-- Contact Section - Onyx -->
<section id="contact" class="section-onyx section-padding">
    <div class="container">
        <div class="row g-5">
            
            <!-- Left: Contact Info -->
            <div class="col-lg-5">
                <div class="mono-label mb-3">[ CONTACT // INITIALIZE ]</div>
                
                <h2 class="display-5 fw-bold text-white mb-4">
                    Start Your <span class="text-gradient">Project</span>
                </h2>
                
                <p class="lead mb-5" style="color: var(--text-muted);">
                    {{ $description }}
                </p>

                <!-- Contact Cards -->
                <div class="d-flex flex-column gap-4">
                    <div class="card-retro p-4" style="box-shadow: 4px 4px 0 0 var(--neon-blue);">
                        <span class="serial-tag">[ COM-01 ]</span>
                        <div class="mono-label mb-2">EMAIL</div>
                        <div class="text-white fw-semibold">{{ $adminEmail }}</div>
                    </div>

                    <div class="card-retro p-4" style="box-shadow: 4px 4px 0 0 var(--neon-cyan);">
                        <span class="serial-tag">[ COM-02 ]</span>
                        <div class="mono-label mb-2">RESPONSE</div>
                        <div class="text-white fw-semibold">Within 24 Hours</div>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="col-lg-7">
                <div class="card-retro p-4 p-lg-5">
                    <span class="serial-tag">[ FORM-01 ]</span>
                    
                    <h5 class="text-white fw-bold mb-4" style="text-transform: uppercase; letter-spacing: 0.1em;">
                        Send Message
                    </h5>
                    
                    <form id="contact-form">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="mono-label mb-2">NAME</label>
                                <input type="text" class="form-control" name="name" placeholder="John Doe" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="mono-label mb-2">EMAIL</label>
                                <input type="email" class="form-control" name="email" placeholder="john@company.com" required>
                            </div>

                            <div class="col-md-6">
                                <label class="mono-label mb-2">SERVICE</label>
                                <select class="form-select" name="service">
                                    <option value="">Select service...</option>
                                    <option value="web">Web Systems</option>
                                    <option value="mobile">Mobile Apps</option>
                                    <option value="ai">AI Integration</option>
                                    <option value="saas">SaaS Platform</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="mono-label mb-2">BUDGET</label>
                                <select class="form-select" name="budget">
                                    <option value="">Select range...</option>
                                    <option value="10-25k">$10K - $25K</option>
                                    <option value="25-50k">$25K - $50K</option>
                                    <option value="50k+">$50K+</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="mono-label mb-2">PROJECT DETAILS</label>
                                <textarea class="form-control" name="message" rows="4" placeholder="Describe your project requirements..." style="resize: none;"></textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn-industrial w-100">
                                    TRANSMIT MESSAGE →
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
