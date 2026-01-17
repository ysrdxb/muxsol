@php
    $footerMenu = \App\Models\Menu::getByLocation('footer');
    $siteName = \App\Models\Setting::get('general.site_name', config('app.name'));
    $siteDescription = \App\Models\Setting::get('general.site_description', '');
    $footerDescription = \App\Models\Setting::get('footer.footer_description', $siteDescription);
    $copyrightText = \App\Models\Setting::get('footer.copyright_text', '');
    $adminEmail = \App\Models\Setting::get('general.admin_email', '');

    // Social links
    $socialTwitter = \App\Models\Setting::get('footer.social_twitter', '');
    $socialLinkedin = \App\Models\Setting::get('footer.social_linkedin', '');
    $socialGithub = \App\Models\Setting::get('footer.social_github', '');
    $socialFacebook = \App\Models\Setting::get('footer.social_facebook', '');
    $socialInstagram = \App\Models\Setting::get('footer.social_instagram', '');

    $hasSocials = $socialTwitter || $socialLinkedin || $socialGithub || $socialFacebook || $socialInstagram;
@endphp

<footer class="site-footer">
    <!-- Main Footer Content -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-16 lg:py-20">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-12 lg:gap-8">
                <!-- Brand Column -->
                <div class="lg:col-span-4">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 group">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[var(--brand-primary)] to-[var(--brand-accent)] flex items-center justify-center shadow-sm transition-transform duration-200 group-hover:scale-105">
                            <span class="text-white font-bold text-base">{{ strtoupper(substr($siteName, 0, 1)) }}</span>
                        </div>
                        <span class="text-lg font-semibold text-white">{{ $siteName }}</span>
                    </a>

                    @if($footerDescription)
                        <p class="mt-4 text-sm text-[var(--gray-400)] leading-relaxed max-w-xs">
                            {{ $footerDescription }}
                        </p>
                    @endif

                    <!-- Social Links -->
                    @if($hasSocials)
                        <div class="mt-6 flex items-center gap-3">
                            @if($socialTwitter)
                                <a href="{{ $socialTwitter }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Twitter">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </a>
                            @endif

                            @if($socialLinkedin)
                                <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="LinkedIn">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            @endif

                            @if($socialGithub)
                                <a href="{{ $socialGithub }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="GitHub">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                    </svg>
                                </a>
                            @endif

                            @if($socialFacebook)
                                <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Facebook">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                    </svg>
                                </a>
                            @endif

                            @if($socialInstagram)
                                <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Instagram">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Navigation Columns -->
                <div class="lg:col-span-8">
                    <div class="grid grid-cols-2 gap-8 sm:grid-cols-3 md:grid-cols-4">
                        <!-- Quick Links -->
                        @if($footerMenu && $footerMenu->items->count() > 0)
                            <div>
                                <h3 class="footer-heading">Navigation</h3>
                                <ul class="mt-4 space-y-3">
                                    @foreach($footerMenu->items->take(6) as $item)
                                        <li>
                                            <a href="{{ $item->url }}" class="footer-link">
                                                {{ $item->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Company Links -->
                        <div>
                            <h3 class="footer-heading">Company</h3>
                            <ul class="mt-4 space-y-3">
                                <li><a href="{{ url('/about') }}" class="footer-link">About Us</a></li>
                                <li><a href="{{ url('/services') }}" class="footer-link">Services</a></li>
                                <li><a href="{{ url('/portfolio') }}" class="footer-link">Portfolio</a></li>
                                <li><a href="{{ url('/contact') }}" class="footer-link">Contact</a></li>
                            </ul>
                        </div>

                        <!-- Legal Links -->
                        <div>
                            <h3 class="footer-heading">Legal</h3>
                            <ul class="mt-4 space-y-3">
                                <li><a href="{{ url('/privacy-policy') }}" class="footer-link">Privacy Policy</a></li>
                                <li><a href="{{ url('/terms-of-service') }}" class="footer-link">Terms of Service</a></li>
                                <li><a href="{{ url('/cookie-policy') }}" class="footer-link">Cookie Policy</a></li>
                            </ul>
                        </div>

                        <!-- Contact -->
                        <div>
                            <h3 class="footer-heading">Contact</h3>
                            <ul class="mt-4 space-y-3">
                                @if($adminEmail)
                                    <li>
                                        <a href="mailto:{{ $adminEmail }}" class="footer-link inline-flex items-center gap-2">
                                            <svg class="w-4 h-4 text-[var(--gray-500)]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                            {{ $adminEmail }}
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ url('/contact') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-[var(--brand-400)] hover:text-[var(--brand-300)] transition-colors">
                                        Get in touch
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="border-t border-[var(--gray-800)] py-6">
            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                <p class="text-sm text-[var(--gray-500)]">
                    @if($copyrightText)
                        {{ $copyrightText }}
                    @else
                        &copy; {{ date('Y') }} {{ $siteName }}. All rights reserved.
                    @endif
                </p>

                <div class="flex items-center gap-6">
                    <a href="{{ url('/privacy-policy') }}" class="text-xs text-[var(--gray-500)] hover:text-[var(--gray-400)] transition-colors">
                        Privacy
                    </a>
                    <a href="{{ url('/terms-of-service') }}" class="text-xs text-[var(--gray-500)] hover:text-[var(--gray-400)] transition-colors">
                        Terms
                    </a>
                    <a href="{{ url('/sitemap.xml') }}" class="text-xs text-[var(--gray-500)] hover:text-[var(--gray-400)] transition-colors">
                        Sitemap
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Footer Base Styles */
    .site-footer {
        background-color: var(--gray-950);
    }

    /* Footer Heading */
    .footer-heading {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--gray-300);
    }

    /* Footer Links */
    .footer-link {
        display: block;
        font-size: 0.875rem;
        color: var(--gray-400);
        transition: color var(--duration-fast) var(--ease-out);
    }

    .footer-link:hover {
        color: white;
    }

    /* Social Links */
    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: var(--radius-md);
        color: var(--gray-400);
        background-color: var(--gray-800);
        transition: all var(--duration-fast) var(--ease-out);
    }

    .social-link:hover {
        color: white;
        background-color: var(--gray-700);
        transform: translateY(-2px);
    }
</style>
