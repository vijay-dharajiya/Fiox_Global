<style>
    /* Uses the same --fiox-* variables already declared in header.blade.php.
       Falls back safely if this partial is ever previewed on its own. */
    :root {
        --fiox-amber: #B8791F;
        --fiox-amber-dark: #8F5F16;
        --fiox-amber-light: #E7B865;
        --fiox-charcoal: #2F2F30;
        --fiox-charcoal-soft: #4A4947;
        --fiox-bg: #FAF8F5;
        --fiox-border: #EDE6DA;
    }

    .site-footer {
        background: var(--fiox-charcoal);
        color: #cfcac4;
        position: relative;
        overflow: hidden;
    }

    .site-footer .footer-glow {
        position: absolute;
        top: -120px;
        right: -80px;
        width: 340px;
        height: 340px;
        background: radial-gradient(circle, rgba(231, 184, 101, 0.16), transparent 70%);
        pointer-events: none;
    }

    .site-footer .footer-main {
        position: relative;
        max-width: 1280px;
        margin: 0 auto;
        padding: 72px 32px 48px;
        display: grid;
        grid-template-columns: 1.3fr 0.9fr 0.9fr 0.9fr 1.2fr;
        gap: 32px;
    }

    /* ---- Brand column ---- */
    .footer-brand img {
        height: 90px;
        width: auto;
        object-fit: contain;
        display: block;
        margin-bottom: 14px;
    }

    .footer-tagline {
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 1.6px;
        text-transform: uppercase;
        color: var(--fiox-amber-light);
        border-top: 2px solid var(--fiox-amber);
        padding-top: 10px;
        margin: 4px 0 20px;
        display: inline-block;
    }

    .footer-desc {
        font-size: 0.88rem;
        line-height: 1.7;
        color: #a8a29a;
        max-width: 34ch;
        margin: 0 0 22px;
    }

    .footer-social {
        display: flex;
        gap: 10px;
    }

    .footer-social a {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #cfcac4;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        text-decoration: none;
        transition: background 0.25s ease, color 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
    }

    .footer-social a:hover {
        background: linear-gradient(135deg, var(--fiox-amber), var(--fiox-amber-dark));
        color: #fff;
        border-color: transparent;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -8px rgba(184, 121, 31, 0.6);
    }

    /* ---- Link columns ---- */
    .footer-col-title {
        font-size: 0.86rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #fff;
        margin: 0 0 22px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-col-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 30px;
        height: 2px;
        background: var(--fiox-amber);
    }

    .footer-links {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 13px;
    }

    .footer-links a {
        color: #a8a29a;
        text-decoration: none;
        font-size: 0.9rem;
        position: relative;
        transition: color 0.2s ease, padding-left 0.2s ease;
    }

    .footer-links a::before {
        content: '\2192';
        position: absolute;
        left: -16px;
        opacity: 0;
        transition: opacity 0.2s ease, left 0.2s ease;
        color: var(--fiox-amber-light);
    }

    .footer-links a:hover {
        color: #fff;
        padding-left: 16px;
    }

    .footer-links a:hover::before {
        opacity: 1;
        left: 0;
    }

    .footer-links li.empty-item a {
        color: #6f6a63;
        cursor: default;
    }

    .footer-links li.empty-item a:hover {
        padding-left: 0;
        color: #6f6a63;
    }

    .footer-links li.empty-item a::before {
        display: none;
    }

    /* ---- Contact info column ---- */
    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 20px;
    }

    .footer-contact-item .icon {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        border-radius: 9px;
        background: rgba(231, 184, 101, 0.12);
        color: var(--fiox-amber-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }

    .footer-contact-item .label {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #8a857d;
        margin-bottom: 3px;
    }

    .footer-contact-item .value,
    .footer-contact-item .value a {
        font-size: 0.92rem;
        font-weight: 600;
        color: #fff;
        line-height: 1.55;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .footer-contact-item .value a:hover {
        color: var(--fiox-amber-light);
    }

    /* ---- Bottom bar ---- */
    .footer-bottom {
        position: relative;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }

    .footer-bottom-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 20px 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .footer-bottom-inner .copy {
        font-size: 0.84rem;
        color: #8a857d;
    }

    /* ---- Floating WhatsApp button ---- */
    .footer-whatsapp {
        position: fixed;
        right: 24px;
        bottom: 24px;
        z-index: 1200;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .footer-whatsapp .wa-tooltip {
        background: #fff;
        color: var(--fiox-charcoal);
        font-size: 0.82rem;
        font-weight: 500;
        padding: 9px 16px;
        border-radius: 8px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        white-space: nowrap;
    }

    .footer-whatsapp .wa-tooltip strong {
        color: #25D366;
    }

    .footer-whatsapp .wa-btn {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #25D366;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        text-decoration: none;
        box-shadow: 0 10px 24px -6px rgba(37, 211, 102, 0.55);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        animation: waPulse 2.4s ease-in-out infinite;
    }

    .footer-whatsapp .wa-btn:hover {
        transform: translateY(-4px) scale(1.06);
        box-shadow: 0 16px 30px -8px rgba(37, 211, 102, 0.7);
    }

    @keyframes waPulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.45), 0 10px 24px -6px rgba(37, 211, 102, 0.55); }
        50%      { box-shadow: 0 0 0 10px rgba(37, 211, 102, 0), 0 10px 24px -6px rgba(37, 211, 102, 0.55); }
    }

    @media (prefers-reduced-motion: reduce) {
        .footer-whatsapp .wa-btn {
            animation: none;
        }
    }

    /* ---- Responsive ---- */
    @media (max-width: 1199px) {
        .site-footer .footer-main {
            grid-template-columns: 1.3fr 1fr 1fr;
            gap: 40px 24px;
        }
    }

    @media (max-width: 991px) {
        .site-footer .footer-main {
            grid-template-columns: 1fr 1fr;
            gap: 40px 24px;
            padding: 56px 24px 36px;
        }
    }

    @media (max-width: 575px) {
        .site-footer .footer-main {
            grid-template-columns: 1fr;
            padding: 48px 20px 32px;
        }

        .footer-whatsapp .wa-tooltip {
            display: none;
        }

        .footer-whatsapp {
            right: 16px;
            bottom: 16px;
        }
    }
</style>

<footer class="site-footer">
    <div class="footer-glow"></div>

    <div class="footer-main">

        <!-- BRAND -->
        <div class="footer-brand">
            <a href="{{ route('index') }}">
                <img src="{{ asset('logo/image123.png') }}" alt="FIOX Global Composites">
            </a>
            <span class="footer-tagline">Engineering The Future With Composites</span>
            <p class="footer-desc">
                FIOX Global Composites supplies GFRP rebar and engineered FRP composite solutions built for strength, durability and corrosion-resistant performance.
            </p>
            <div class="footer-social">
                <a href="https://www.facebook.com/Fioxcomposites" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.instagram.com/fiox_composites/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.linkedin.com/company/fiox-global-composites/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                    <i class="bi bi-linkedin"></i>
                </a>
                <a href="https://www.youtube.com/@FioxComposites" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                    <i class="bi bi-youtube"></i>
                </a>
            </div>
        </div>

        <!-- QUICK LINKS -->
        <div class="footer-col">
            <div class="footer-col-title">Quick Links</div>
            <ul class="footer-links">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('about_us') }}">About Us</a></li>
                <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
            </ul>
        </div>

        <!-- PRODUCTS -->
        <div class="footer-col">
            <div class="footer-col-title">Products</div>
            <ul class="footer-links">
                @php
                    $footerProducts = \App\Models\Product::where('status', 'active')
                        ->orderBy('position', 'asc')
                        ->limit(6)
                        ->get();
                @endphp

                @forelse ($footerProducts as $fp)
                    <li>
                        @if (!empty($fp->slug))
                            <a href="{{ route('product.show', $fp->slug) }}">{{ $fp->name }}</a>
                        @else
                            <a href="{{ route('index') }}">{{ $fp->name }}</a>
                        @endif
                    </li>
                @empty
                    <li class="empty-item"><a href="#">No products available</a></li>
                @endforelse
            </ul>
        </div>

        <!-- APPLICATIONS -->
        <div class="footer-col">
            <div class="footer-col-title">Applications</div>
            <ul class="footer-links">
                @php
                    $footerApplications = \App\Models\Application::where('status', 'active')
                        ->orderBy('position', 'asc')
                        ->limit(6)
                        ->get();
                @endphp

                @forelse ($footerApplications as $fa)
                    <li>
                        @if (!empty($fa->slug))
                            <a href="{{ route('application.show', $fa->slug) }}">{{ $fa->name }}</a>
                        @else
                            <a href="{{ route('index') }}">{{ $fa->name }}</a>
                        @endif
                    </li>
                @empty
                    <li class="empty-item"><a href="#">No applications available</a></li>
                @endforelse
            </ul>
        </div>

        <!-- CONTACT INFO -->
        <div class="footer-col">
            <div class="footer-col-title">Contact Info</div>

            <div class="footer-contact-item">
                <div class="icon"><i class="bi bi-telephone-fill"></i></div>
                <div>
                    <div class="label">Call Us</div>
                    <div class="value"><a href="tel:+919228270185">+91 92282 70185</a></div>
                </div>
            </div>

            <div class="footer-contact-item">
                <div class="icon"><i class="bi bi-envelope-fill"></i></div>
                <div>
                    <div class="label">Email Us</div>
                    <div class="value"><a href="mailto:fioxcomposites@gmail.com">fioxcomposites@gmail.com</a></div>
                </div>
            </div>

            <div class="footer-contact-item">
                <div class="icon"><i class="bi bi-envelope-fill"></i></div>
                <div>
                    <div class="label">FOR EXPORT ENQUIRIES</div>
                    <div class="value"><a href="mailto:export@fioxcomposites.com">export@fioxcomposites.com</a></div>
                </div>
            </div>

            <div class="footer-contact-item">
                <div class="icon"><i class="bi bi-geo-alt-fill"></i></div>
                <div>
                    <div class="label">Location</div>
                    <div class="value">
                        105, Vinayak Complex, Sadhu Vasvani Rd,<br>
                        Nr. Gangotri Dairy, Rajkot, Gujarat &ndash; 360 005.
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- BOTTOM BAR -->
    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <div class="copy">Copyright &copy; {{ date('Y') }} FIOX Global Composites. All Rights Reserved.</div>
        </div>
    </div>
</footer>

<!-- FLOATING WHATSAPP CHAT BUTTON -->
<div class="footer-whatsapp">
    <span class="wa-tooltip">Need Help? <strong>Chat with us</strong></span>
    <a class="wa-btn"
       href="https://wa.me/919228270185?text=Hi%20FIOX%20Global%20Composites%2C%20I%20have%20a%20question."
       target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
</div>