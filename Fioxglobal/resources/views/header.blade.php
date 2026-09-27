<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('logo/favicon.png') }}">

<style>
    :root {
        --fiox-amber: #B8791F;
        --fiox-amber-dark: #8F5F16;
        --fiox-amber-light: #E7B865;
        --fiox-charcoal: #2F2F30;
        --fiox-charcoal-soft: #4A4947;
        --fiox-bg: #FAF8F5;
        --fiox-border: #EDE6DA;
    }

    /* ===== GLOBAL FIX: kills the bottom horizontal scrollbar on every page.
       box-sizing:border-box makes padding/borders count INSIDE an element's
       declared width instead of adding to it, and overflow-x:hidden on
       html/body clips anything that still edges past the viewport
       (e.g. the fixed-position mobile nav panel below). This is loaded
       once here so it applies site-wide since every page extends this layout. */
    *, *::before, *::after {
        box-sizing: border-box;
    }

    html, body {
        max-width: 100%;
        overflow-x: hidden;
    }

    * {
        font-family: 'Poppins', 'Segoe UI', sans-serif;
    }

    /* Header is now fixed (not sticky), so it's out of normal document
       flow. This padding-top keeps page content from sliding under it. */
    body {
        padding-top: 80px;
    }

    .site-header {
        background: #FFFFFF;
        border-bottom: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1050;
        box-shadow: 0 2px 14px rgba(184, 121, 31, 0.06);
        width: 100%;
    }

    .site-header .header-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 32px;
        height: 75px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* ===== LOGO ===== */
    .site-header .brand-logo {
        display: flex;
        align-items: center;
        flex-shrink: 0;
        height: 100%;
        max-height: 70px;
        overflow: hidden; /* clips the image so it can never spill past its box */
    }

    .site-header .brand-logo img {
        height: 66px;
        max-height: 100%;
        width: auto;
        max-width: 100%;
        object-fit: contain;
        display: block;
    }

    /* ===== NAV ===== */
    .site-header .site-nav {
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .site-header .site-nav li {
        position: relative;
    }

    .site-header .site-nav li a {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 10px 20px;
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        font-size: 0.92rem;
        font-weight: 500;
        letter-spacing: 0.3px;
        color: var(--fiox-charcoal-soft);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .site-header .site-nav li a::after {
        content: '';
        position: absolute;
        left: 20px;
        right: 20px;
        bottom: 6px;
        height: 2px;
        background: linear-gradient(90deg, var(--fiox-amber), var(--fiox-amber-dark));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.25s ease;
    }

    .site-header .site-nav li a:hover {
        color: var(--fiox-amber-dark);
    }

    .site-header .site-nav li a:hover::after {
        transform: scaleX(1);
    }

    .site-header .site-nav li a.active {
        color: var(--fiox-amber-dark);
        font-weight: 600;
    }

    .site-header .site-nav li a.active::after {
        transform: scaleX(1);
    }

    /* Hidden on desktop — only appears inside the mobile side-card panel */
    .site-nav-head {
        display: none;
    }

    /* ===== DROPDOWNS (Products / Applications / Downloads) ===== */
    .nav-dropdown .dropdown-caret {
        font-size: 0.7rem;
        transition: transform 0.2s ease;
    }

    .nav-dropdown.open .dropdown-caret,
    .nav-dropdown:hover .dropdown-caret {
        transform: rotate(180deg);
    }

    /* Golden underline + amber text on the dropdown trigger itself,
       whenever its menu is open (hover on desktop, .open on mobile) —
       matching the same treatment Home / About / Contact get. */
    .nav-dropdown:hover > a,
    .nav-dropdown.open > a {
        color: var(--fiox-amber-dark);
    }

    .nav-dropdown:hover > a::after,
    .nav-dropdown.open > a::after {
        transform: scaleX(1);
    }

    .nav-dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        min-width: 100px;
        width: max-content;
        max-width: 300px;
        background: #fff;
        border: 1px solid var(--fiox-border);
        border-radius: 14px;
        box-shadow: 0 20px 40px rgba(47, 47, 48, 0.12);
        padding: 14px;
        margin: 0;
        list-style: none;
        opacity: 0;
        visibility: hidden;
        transform: translateY(8px);
        transition: all 0.2s ease;
        z-index: 1060;
    }

    .nav-dropdown:hover .nav-dropdown-menu,
    .nav-dropdown.open .nav-dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(4px);
    }

    .nav-dropdown-menu li a {
        display: flex;
        align-items: center;
        padding: 14px 18px;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--fiox-charcoal-soft);
        white-space: normal;
        word-break: break-word;
        overflow-wrap: break-word;
    }

    .nav-dropdown-menu li a::after {
        display: none;
    }

    .nav-dropdown-menu li a:hover {
        background: rgba(184, 121, 31, 0.07);
        color: var(--fiox-amber-dark);
    }

    .nav-dropdown-menu li.empty-item a {
        color: var(--fiox-text-muted, #9a948b);
        cursor: default;
    }

    .nav-dropdown-menu li.empty-item a:hover {
        background: none;
        color: var(--fiox-text-muted, #9a948b);
    }

    .nav-dropdown-menu .brochure-item a {
        justify-content: space-between;
        gap: 12px;
    }

    .nav-dropdown-menu .brochure-name {
        display: flex;
        align-items: center;
        gap: 8px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .nav-dropdown-menu .brochure-size {
        font-size: 0.72rem;
        font-weight: 400;
        color: var(--fiox-text-muted, #9a948b);
        flex-shrink: 0;
    }

    .nav-dropdown-menu .bi-file-earmark-pdf-fill {
        color: var(--fiox-amber-dark);
        flex-shrink: 0;
    }

    /* ===== DROPDOWN ITEM SEPARATOR ===== */
    .nav-dropdown-menu li hr {
        margin: 2px 10px;
        border: none;
        border-top: 1px solid rgba(184, 121, 31, 0.18);
        opacity: 0.1;
    }

    .nav-dropdown-menu li:last-child hr {
        display: none;
    }

    /* ===== MOBILE TOGGLER ===== */
    .site-header .nav-toggler {
        display: none;
        background: none;
        border: none;
        width: 42px;
        height: 42px;
        border-radius: 8px;
        align-items: center;
        justify-content: center;
        color: var(--fiox-charcoal);
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .site-header .nav-toggler:hover {
        background: rgba(184, 121, 31, 0.08);
    }

    /* Dark backdrop behind the mobile side-card nav */
    .nav-overlay {
        position: fixed;
        inset: 0;
        background: rgba(47, 47, 48, 0.5);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        z-index: 1090;
        display: none;
    }

    .nav-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    @media (max-width: 991px) {
        body {
            padding-top: 64px;
        }

        .site-header .header-inner {
            height: 64px;
            padding: 0 16px;
        }

        /* FIX: logo height now fits comfortably inside the 64px mobile
           header instead of the old 90px, which was taller than the bar
           itself and overlapped the toggler/border. */
        .site-header .brand-logo {
            max-height: 48px;
        }

        .site-header .brand-logo img {
            height: 48px;
        }

        .site-header .nav-toggler {
            display: flex;
        }

        .nav-overlay {
            display: block;
        }

        /* ===== SIDE CARD NAV ===== */
        .site-header .site-nav {
            position: fixed;
            top: 0;
            right: -320px;
            left: auto;
            width: 250px;
            max-width: 85%;
            height: 100vh;
            margin: 0;
            background: #fff;
            flex-direction: column;
            align-items: stretch;
            gap: 0;
            max-height: none;
            overflow-x: hidden;
            overflow-y: auto;
            box-shadow: -10px 0 40px rgba(47, 47, 48, 0.2);
            transition: right 0.35s cubic-bezier(.22, 1, .36, 1);
            z-index: 1100;
        }

        .site-header .site-nav.show {
            right: 0;
        }

        .site-nav-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            border-bottom: 1px solid var(--fiox-border);
            flex-shrink: 0;
        }

        .site-nav-head span {
            font-weight: 700;
            font-size: 1rem;
            color: var(--fiox-charcoal);
            letter-spacing: 0.3px;
        }

        .nav-panel-close {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: none;
            background: rgba(184, 121, 31, 0.08);
            color: var(--fiox-charcoal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .nav-panel-close:hover {
            background: rgba(184, 121, 31, 0.16);
            color: var(--fiox-amber-dark);
        }

        .site-header .site-nav li a {
            padding: 16px 24px;
            border-bottom: 1px solid var(--fiox-border);
        }

        .site-header .site-nav li a::after {
            display: none;
        }

        .site-header .site-nav li a.active {
            background: rgba(184, 121, 31, 0.06);
        }

        .nav-dropdown-menu {
            position: static;
            width: 100%;
            max-width: 100%;
            opacity: 1;
            visibility: visible;
            transform: none;
            box-shadow: none;
            border: none;
            border-radius: 0;
            padding: 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.25s ease;
        }

        .nav-dropdown.open .nav-dropdown-menu {
            max-height: 500px;
            overflow-y: auto;
        }

        .nav-dropdown-menu li a {
            padding: 12px 40px;
            border-bottom: 1px solid var(--fiox-border);
            border-radius: 0;
        }

        .nav-dropdown-menu li hr {
            margin: 0;
            border-top: 1px solid rgba(184, 121, 31, 0.18);
        }
    }

    /* Extra-small phones: shrink the logo a bit further so it never
       crowds the toggler button on very narrow screens. */
    @media (max-width: 420px) {
        .site-header .header-inner {
            padding: 0 12px;
        }

        .site-header .brand-logo {
            max-height: 40px;
        }

        .site-header .brand-logo img {
            height: 40px;
        }
    }
</style>

<header class="site-header">
    <div class="header-inner">

        <!-- LOGO -->
        <a href="{{ route('index') }}" class="brand-logo">
            <img src="{{ asset('logo/123.jpeg') }}" alt="FIOX Global Composites">
        </a>

        <!-- DARK BACKDROP FOR MOBILE SIDE-CARD NAV -->
        <div class="nav-overlay" id="navOverlay"></div>

        <!-- NAV -->
        <ul class="site-nav" id="siteNav">

            <!-- Mobile-only panel header (hidden on desktop) -->
            <li class="site-nav-head">
                <span>Menu</span>
                <button type="button" class="nav-panel-close" id="navPanelClose" aria-label="Close menu">
                    <i class="bi bi-x-lg"></i>
                </button>
            </li>

            <li><a href="{{ route('index') }}" class="{{ request()->routeIs('index') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('about_us') }}" class="{{ request()->routeIs('about_us') ? 'active' : '' }}">About Us</a></li>

            <!-- PRODUCTS DROPDOWN -->
            <li class="nav-dropdown" id="productsDropdown">
                <a href="#" id="productsDropdownToggle" class="{{ request()->routeIs('product.show') ? 'active' : '' }}">
                    Products <i class="bi bi-chevron-down dropdown-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    @php
                        $navProducts = \App\Models\Product::where('status', 'active')
                        ->orderBy('position', 'asc')   // <-- use your actual sort column name
                        ->get();
                    @endphp

                    @forelse ($navProducts as $navProduct)
                        <li>
                            <a href="{{ route('product.show', $navProduct->slug) }}">
                                {{ $navProduct->name }}
                            </a>
                            <hr>
                        </li>
                    @empty
                        <li class="empty-item">
                            <a href="#">No products available</a>
                        </li>
                    @endforelse
                </ul>
            </li>

            <!-- APPLICATIONS DROPDOWN -->
            <li class="nav-dropdown" id="applicationsDropdown">
                <a href="#" id="applicationsDropdownToggle" class="{{ request()->routeIs('application.show') ? 'active' : '' }}">
                    Applications <i class="bi bi-chevron-down dropdown-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    @php
                        $navApplications = \App\Models\Application::where('status', 'active')
                            ->orderBy('position', 'asc')
                            ->get();
                    @endphp

                    @forelse ($navApplications as $navApplication)
                        <li>
                            <a href="{{ route('application.show', $navApplication->id) }}">
                                {{ $navApplication->name }}
                            </a>
                            <hr>
                        </li>
                    @empty
                        <li class="empty-item">
                            <a href="#">No applications available</a>
                        </li>
                    @endforelse
                </ul>
            </li>

            <li><a href="{{ route('contact_us') }}" class="{{ request()->routeIs('contact_us') ? 'active' : '' }}">Contact Us</a></li>

            <!-- DOWNLOADS DROPDOWN (Brochures) -->
            <li class="nav-dropdown" id="downloadsDropdown">
                <a href="#" id="downloadsDropdownToggle">
                    Downloads <i class="bi bi-chevron-down dropdown-caret"></i>
                </a>
                <ul class="nav-dropdown-menu">
                    @php
                        $navBrochures = \App\Models\Brochure::orderBy('title')->get();
                    @endphp

                    @forelse ($navBrochures as $navBrochure)
                        <li class="brochure-item">
                            <a href="{{ route('brochure.download', $navBrochure->id) }}">
                                <span class="brochure-name">
                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                    {{ $navBrochure->title }}
                                </span>
                            </a>
                            <hr>
                        </li>
                    @empty
                        <li class="empty-item">
                            <a href="#">No brochures available</a>
                        </li>
                    @endforelse
                </ul>
            </li>
        </ul>

        <!-- MOBILE TOGGLE -->
        <button class="nav-toggler" id="navToggler" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
        </button>
    </div>
</header>

<div class="container-fluid py-1">
    @yield('content')

</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const navToggler   = document.getElementById('navToggler');
    const siteNav       = document.getElementById('siteNav');
    const navOverlay     = document.getElementById('navOverlay');
    const navPanelClose  = document.getElementById('navPanelClose');

    function openNav() {
        siteNav.classList.add('show');
        navOverlay?.classList.add('show');
        document.body.style.overflow = 'hidden';
        navToggler.querySelector('i').classList.remove('bi-list');
        navToggler.querySelector('i').classList.add('bi-x-lg');
    }

    function closeNav() {
        siteNav.classList.remove('show');
        navOverlay?.classList.remove('show');
        document.body.style.overflow = '';
        navToggler.querySelector('i').classList.remove('bi-x-lg');
        navToggler.querySelector('i').classList.add('bi-list');
    }

    navToggler?.addEventListener('click', function () {
        siteNav.classList.contains('show') ? closeNav() : openNav();
    });

    navOverlay?.addEventListener('click', closeNav);
    navPanelClose?.addEventListener('click', closeNav);

    function initNavDropdown(id, toggleId) {
        const dropdown = document.getElementById(id);
        const toggle = document.getElementById(toggleId);
        if (!dropdown || !toggle) return;

        toggle.addEventListener('click', function (e) {
            if (window.innerWidth <= 991) {
                e.preventDefault();
                dropdown.classList.toggle('open');
            }
        });

        document.addEventListener('click', function (e) {
            if (!dropdown.contains(e.target) && window.innerWidth <= 991) {
                dropdown.classList.remove('open');
            }
        });
    }

    initNavDropdown('productsDropdown', 'productsDropdownToggle');
    initNavDropdown('applicationsDropdown', 'applicationsDropdownToggle');
    initNavDropdown('downloadsDropdown', 'downloadsDropdownToggle');
</script>