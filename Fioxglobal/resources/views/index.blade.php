@extends('header')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIOX Global Composites</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

        * { font-family: 'Poppins', 'Segoe UI', sans-serif; }

        body {
            margin: 0;
            background: #fff;
            color: var(--fiox-charcoal-soft);
        }

        .section-wrap {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 32px;
        }

        /* ================= HERO ================= */
        .hero {
            position: relative;
            background:
                linear-gradient(115deg, rgba(47,47,48,0.92) 0%, rgba(47,47,48,0.78) 45%, rgba(184,121,31,0.55) 100%),
                url('{{ asset("logo/bg-1.avif") }}') center/cover no-repeat;
            padding: 56px 0 130px;
        }

        .hero .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(231, 184, 101, 0.15);
            border: 1px solid rgba(231, 184, 101, 0.4);
            color: var(--fiox-amber-light);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 7px 16px;
            border-radius: 30px;
            margin-bottom: 22px;
            opacity: 0;
            animation: heroRise 0.6s ease forwards;
        }

        .hero h1 {
            color: #fff;
            font-size: 3.1rem;
            font-weight: 800;
            line-height: 1.15;
            max-width: 780px;
            margin-bottom: 22px;
            opacity: 0;
            animation: heroRise 0.7s ease 0.1s forwards;
        }

        .hero h1 span {
            background: linear-gradient(90deg, var(--fiox-amber-light), var(--fiox-amber));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p.lead {
            color: rgba(255,255,255,0.82);
            font-size: 1.08rem;
            font-weight: 400;
            line-height: 1.75;
            max-width: 620px;
            margin-bottom: 34px;
            opacity: 0;
            animation: heroRise 0.7s ease 0.2s forwards;
        }

        .hero .hero-cta {
            opacity: 0;
            animation: heroRise 0.7s ease 0.3s forwards;
        }

        @keyframes heroRise {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn-fiox-solid {
            background: linear-gradient(90deg, var(--fiox-amber), var(--fiox-amber-dark));
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 14px 30px;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.2px;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-fiox-solid:hover {
            color: #fff;
            box-shadow: 0 8px 22px rgba(184, 121, 31, 0.35);
            transform: translateY(-2px);
        }

        .btn-fiox-ghost {
            background: transparent;
            color: #fff;
            border: 1.5px solid rgba(255,255,255,0.5);
            border-radius: 8px;
            padding: 14px 30px;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.2px;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-fiox-ghost:hover {
            background: rgba(255,255,255,0.1);
            border-color: #fff;
            color: #fff;
        }

        /* ---- Centered GFRP product line with shimmer effect ---- */
        .gfrp-line-wrap {
            margin-top: 40px;
            text-align: center;
            opacity: 0;
            animation: heroRise 0.7s ease 0.4s forwards;
        }

        .gfrp-line {
            display: inline-flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 10px 16px;
            padding: 14px 30px;
            border-top: 1px solid rgba(255,255,255,0.18);
            border-bottom: 1px solid rgba(255,255,255,0.18);
        }

        .gfrp-line .gfrp-item {
            background: linear-gradient(90deg, #ffffff 0%, var(--fiox-amber-light) 50%, #ffffff 100%);
            background-size: 220% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            white-space: nowrap;
            animation: shine 6s linear infinite;
        }

        .gfrp-line .gfrp-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--fiox-amber-light);
            opacity: 0.8;
        }

        @keyframes shine {
            to { background-position: -220% center; }
        }

        @media (prefers-reduced-motion: reduce) {
            .hero .eyebrow, .hero h1, .hero p.lead, .hero .hero-cta, .gfrp-line-wrap {
                opacity: 1; animation: none;
            }
            .gfrp-line .gfrp-item { animation: none; }
        }

        /* ================= STATS BAR ================= */
        .stats-bar {
            margin-top: -72px;
            position: relative;
            z-index: 5;
        }

        .stats-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 16px 40px rgba(47, 47, 48, 0.12);
            padding: 10px;
        }

        .stat-item {
            padding: 26px 20px;
            text-align: center;
            border-right: 1px solid var(--fiox-border);
        }

        .stat-item:last-child { border-right: none; }

        .stat-icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(184, 121, 31, 0.1);
            color: var(--fiox-amber-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin: 0 auto 12px;
            transition: transform 0.25s ease, background 0.25s ease;
        }

        .stat-item:hover .stat-icon-circle {
            transform: scale(1.08);
            background: rgba(184, 121, 31, 0.16);
        }

        .stat-label {
            font-size: 0.82rem;
            color: var(--fiox-charcoal-soft);
            font-weight: 500;
        }

        @media (max-width: 767px) {
            .stat-item { border-right: none; border-bottom: 1px solid var(--fiox-border); }
            .stat-item:last-child { border-bottom: none; }
        }

        /* ================= PROBLEM / SOLUTION TEXT CARDS ================= */
        .intro-section {
            padding: 50px 0 40px;
            background: #fff;
        }

        .intro-tag {
            color: var(--fiox-amber-dark);
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .problem-card {
            background: var(--fiox-charcoal);
            border-radius: 18px;
            padding: 48px 42px;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .problem-card::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(184, 121, 31, 0.15);
        }

        .problem-card .crack-line {
            width: 46px;
            height: 3px;
            background: var(--fiox-amber);
            margin-bottom: 24px;
        }

        .problem-card h3 {
            color: #fff;
            font-size: 1.65rem;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 16px;
            position: relative;
        }

        .problem-card p {
            color: rgba(255,255,255,0.6);
            font-size: 1rem;
            line-height: 1.8;
            margin: 0;
            position: relative;
        }

        .solution-card {
            background: #fff;
            border: 1px solid var(--fiox-border);
            border-top: 4px solid var(--fiox-amber);
            border-radius: 18px;
            padding: 48px 42px;
            height: 100%;
            box-shadow: 0 12px 32px rgba(47, 47, 48, 0.05);
        }

        .solution-card .badge-solved {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(60, 150, 95, 0.1);
            color: #3c965f;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 20px;
            margin-bottom: 22px;
        }

        .solution-card h3 {
            color: var(--fiox-charcoal);
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 16px;
        }

        .solution-card p {
            color: var(--fiox-charcoal-soft);
            font-size: 1rem;
            line-height: 1.85;
            margin-bottom: 28px;
        }

        .solution-card .solution-cta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn-fiox-primary-sm {
            background: linear-gradient(90deg, var(--fiox-amber), var(--fiox-amber-dark));
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 11px 22px;
            font-size: 0.86rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-fiox-primary-sm:hover { color: #fff; opacity: 0.92; }

        .btn-fiox-outline-sm {
            background: #fff;
            color: var(--fiox-amber-dark);
            border: 1.5px solid var(--fiox-amber);
            border-radius: 8px;
            padding: 11px 22px;
            font-size: 0.86rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-fiox-outline-sm:hover {
            background: var(--fiox-amber);
            color: #fff;
        }

        /* ================= WHY FIOX SECTION ================= */
        .why-fiox-section {
            padding: 0 0 70px;
            background: #fff ; /*var(--fiox-bg); */
        }

        .why-fiox-card {
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(47, 47, 48, 0.08);
            display: flex;
            flex-wrap: wrap;
        }

        .why-fiox-left {
            background: var(--fiox-charcoal);
            color: #fff;
            flex: 1 1 340px;
            padding: 50px 36px;
            display: flex;
            align-items: center;
            gap: 18px;
            position: relative;
            overflow: hidden;
        }

        .why-fiox-text {
            flex: 1 1 auto;
            min-width: 0;
        }

        .why-fiox-mark {
            flex: none;
            font-size: 250px;
            font-weight: 800;
            line-height: 1;
            color: transparent;
            -webkit-text-stroke: 3px rgba(184, 121, 31, 0.75);
            pointer-events: none;
            user-select: none;
        }

        .why-fiox-left .crack-line {
            width: 46px;
            height: 3px;
            background: var(--fiox-amber);
            margin-bottom: 22px;
        }

        .why-fiox-left h3 {
            font-size: 1.7rem;
            font-weight: 800;
            margin-bottom: 14px;
        }

        .why-fiox-left p {
            color: rgba(255,255,255,0.62);
            font-size: 0.95rem;
            line-height: 1.8;
            margin: 0;
        }

        .why-fiox-right {
            background: #fff;
            flex: 1 1 420px;
            padding: 44px;
        }

        .why-fiox-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px 28px;
        }

        .why-fiox-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .why-fiox-item .icon-box {
            flex: none;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: rgba(184, 121, 31, 0.1);
            color: var(--fiox-amber-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
        }

        .why-fiox-item span.label {
            font-size: 0.96rem;
            font-weight: 600;
            color: var(--fiox-charcoal);
            line-height: 1.4;
            padding-top: 8px;
        }

        @media (max-width: 575px) {
            .why-fiox-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 767px) {
            .hero { padding: 40px 0 150px; }
            .hero h1 { font-size: 2.1rem; }
            .intro-section { padding: 50px 0 40px; }
            .problem-card, .solution-card { padding: 34px 26px; }
            .why-fiox-left { padding: 38px 28px; gap: 10px; }
            .why-fiox-right { padding: 38px 28px; }
            .why-fiox-mark { font-size: 70px; }
        }

        /* ================= PRODUCTS SHOWCASE ================= */
        .products-showcase {
            padding: 30px 0 20px;
            background: #fff;
        }

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 28px;
        }

        .product-tile {
            flex: 0 1 260px;
            max-width: 260px;
            background: #fff;
            border: 1px solid var(--fiox-border);
            border-radius: 18px;
            overflow: hidden;
            text-decoration: none;
            box-shadow: 0 10px 26px rgba(47, 47, 48, 0.06);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .product-tile:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(184, 121, 31, 0.18);
            border-color: var(--fiox-amber);
        }

        .product-tile-img {
            width: 100%;
            aspect-ratio: 1 / 1;
            background: var(--fiox-bg);
            overflow: hidden;
        }

        .product-tile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease;
        }

        .product-tile:hover .product-tile-img img {
            transform: scale(1.08);
        }

        .product-tile-name {
            padding: 16px 14px;
            text-align: center;
            font-size: 0.98rem;
            font-weight: 600;
            color: var(--fiox-charcoal);
        }

        @media (max-width: 575px) {
            .product-tile { flex: 0 1 100%; max-width: 320px; }
        }
    </style>
</head>
<body>

    <!-- ================= HERO ================= -->
    <section class="hero">
        <div class="section-wrap">
            <span class="eyebrow"><i class="bi bi-shield-check"></i> Glass Fiber Reinforced Polymer Solutions</span>
            <h1>Redefining <span>Tomorrow's</span> Infrastructure</h1>
            <p class="lead">
                <b>FIOX Global Composites supplies advanced FRP and GFRP solutions for infrastructure, construction, industrial, marine and utility applications.</b>
            </p>
            <div class="d-flex flex-wrap gap-3 hero-cta">
                <!-- <a href="#" class="btn-fiox-solid">
                    <i class="bi bi-file-earmark-text"></i> Explore Products
                </a> -->
                <a href="{{ route('contact_us') }}" class="btn-fiox-ghost">
                    <i class="bi bi-box-seam"></i> Get a quote
                </a>
            </div>

            <div class="gfrp-line-wrap">
                <div class="gfrp-line">
                    <span class="gfrp-item">GFRP Rebar</span>
                    <span class="gfrp-dot"></span>
                    <span class="gfrp-item">FRP Gratings</span>
                    <span class="gfrp-dot"></span>
                    <span class="gfrp-item">FRP Manhole Covers</span>
                    <span class="gfrp-dot"></span>
                    <span class="gfrp-item">FRP Cable Trays</span>
                    <span class="gfrp-dot"></span>
                    <span class="gfrp-item">Custom FRP Solutions</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= STATS BAR ================= -->
    <div class="section-wrap stats-bar">
        <div class="stats-card">
            <div class="row g-0">
                <div class="col-6 col-md-3 stat-item">
                    <div class="stat-icon-circle"><i class="bi bi-shield-check"></i></div>
                    <div class="stat-label">Corrosion Resistant </div>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <div class="stat-icon-circle"><i class="bi bi-feather"></i></div>
                    <div class="stat-label"> Lightweight & High Strength </div>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <div class="stat-icon-circle"><i class="bi bi-lightning-charge"></i></div>
                    <div class="stat-label"> Electrically Non-Conductive </div>
                </div>
                <div class="col-6 col-md-3 stat-item">
                    <div class="stat-icon-circle"><i class="bi bi-gear-wide-connected"></i></div>
                    <div class="stat-label"> Engineered FRP Products </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= PRODUCTS SHOWCASE ================= -->
    <section class="products-showcase">
        <div class="section-wrap">
            <div class="text-center my-3">
                <div class="intro-tag">Our Product Range</div>
            </div>

            <div class="product-grid">
                @php
                    $homeProducts = \App\Models\Product::where('status', 'active')
                        ->orderBy('position', 'asc') // swap to your admin reorder column once confirmed
                        ->get();
                @endphp

                @forelse ($homeProducts as $homeProduct)
                    <a href="{{ route('product.show', $homeProduct->slug) }}" class="product-tile">
                        <div class="product-tile-img">
                            <img src="{{ asset('product/' . $homeProduct->image) }}" alt="{{ $homeProduct->name }}">
                        </div>
                        <div class="product-tile-name">{{ $homeProduct->name }}</div>
                    </a>
                @empty
                    <p class="text-muted text-center w-100">No products available yet.</p>
                @endforelse
            </div>
        </div>
    </section>
    <!-- ================= PROBLEM / SOLUTION TEXT CARDS ================= -->
    <section class="intro-section">
        <div class="section-wrap">
            <div class="text-center mb-4">
                <div class="intro-tag">Why It Matters</div>
                <h2 class="fw-bold" style="color: var(--fiox-charcoal); font-size: 1.75rem;">
                    The Hidden Cost of Traditional Reinforcement
                </h2>
            </div>

            <div class="row g-4 align-items-stretch">
                <!-- PROBLEM CARD -->
                <div class="col-lg-5">
                    <div class="problem-card">
                        <div class="crack-line"></div>
                        <h3>Steel rusts. Concrete cracks.</h3>
                        <p>
                            Structures weaken &mdash; slowly, silently, from the inside out.
                            What starts as a hairline crack becomes a structural liability,
                            years before anyone notices.
                        </p>
                    </div>
                </div>

                <!-- SOLUTION CARD -->
                <div class="col-lg-7">
                    <div class="solution-card">
                        <span class="badge-solved"><i class="bi bi-check-circle-fill"></i> The FIOX Solution</span>
                        <h3>Corrosion, solved at the source.</h3>
                        <p>
                            At FIOX Global Composites, we solve corrosion at the source with GFRP rebar
                            that never corrodes. Lighter than steel, it offers long-term durability with
                            low maintenance. No rust. No compromise. Just stronger, smarter infrastructure.
                        </p>
                        <div class="solution-cta">
                            <a href="{{ route('contact_us') }}" class="btn-fiox-outline-sm">
                                <i class="bi bi-box-seam"></i>Request a Sample
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= WHY FIOX ================= -->
    <section class="why-fiox-section">
        <div class="section-wrap">
            <div class="why-fiox-card">
                <div class="why-fiox-left">
                    <div class="why-fiox-text">
                        <div class="crack-line"></div>
                        <h3>Why Choose FIOX</h3>
                        <p>
                            At FIOX Global Composites, our values guide the way we develop
                            products, serve customers and build long-term relationships.
                        </p>
                    </div>
                    <div class="why-fiox-mark">?</div>
                </div>
                <div class="why-fiox-right">
                    <div class="why-fiox-grid">
                        <div class="why-fiox-item">
                            <div class="icon-box"><i class="bi bi-gem"></i></div>
                            <span class="label">Quality</span>
                        </div>
                        <div class="why-fiox-item">
                            <div class="icon-box"><i class="bi bi-shield-check"></i></div>
                            <span class="label">Durability</span>
                        </div>
                        <div class="why-fiox-item">
                            <div class="icon-box"><i class="bi bi-lightbulb"></i></div>
                            <span class="label">Innovation</span>
                        </div>
                        <div class="why-fiox-item">
                            <div class="icon-box"><i class="bi bi-gear-wide-connected"></i></div>
                            <span class="label">Engineering Excellence</span>
                        </div>
                        <div class="why-fiox-item">
                            <div class="icon-box"><i class="bi bi-hand-thumbs-up"></i></div>
                            <span class="label">Integrity</span>
                        </div>
                        <div class="why-fiox-item">
                            <div class="icon-box"><i class="bi bi-recycle"></i></div>
                            <span class="label">Sustainability</span>
                        </div>
                        <div class="why-fiox-item">
                            <div class="icon-box"><i class="bi bi-people"></i></div>
                            <span class="label">Customer Focus</span>
                        </div>
                        <div class="why-fiox-item">
                            <div class="icon-box"><i class="bi bi-award"></i></div>
                            <span class="label">Reliability</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection