@extends('header')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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

        /* ================= PAGE BANNER ================= */
        .page-banner {
            position: relative;
            background:
                linear-gradient(115deg, rgba(47,47,48,0.62) 0%, rgba(47,47,48,0.42) 50%, rgba(184,121,31,0.3) 100%),
                url('{{ asset("logo/gfrp.jpg") }}') center/cover no-repeat;
            padding: 100px 0;
            text-align: center;
        }

        .page-banner h1 {
            color: #fff;
            font-size: 2.6rem;
            font-weight: 800;
            margin: 0;
            text-shadow: 0 2px 18px rgba(0,0,0,0.55);
        }

        /* subtext line below the H1 */
        .page-banner .banner-subtext {
            color: rgba(255, 255, 255, 0.92);
            font-size: 1.05rem;
            font-weight: 400;
            line-height: 1.7;
            max-width: 720px;
            margin: 18px auto 0;
            text-shadow: 0 2px 12px rgba(0,0,0,0.5);
        }

        /* ================= SECTION HEADING ================= */
        .section-tag {
            color: var(--fiox-amber-dark);
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .section-title {
            color: var(--fiox-charcoal);
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0;
        }

        /* ================= WHO WE ARE ================= */
        .who-we-are {
            padding: 100px 0 90px;
        }

        .who-we-are .who-we-are-tag {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 22px;
        }

        .who-we-are .brand-mark {
            width: 64px;
            height: 64px;
            flex-shrink: 0;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--fiox-amber), var(--fiox-amber-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.7rem;
        }

        .who-we-are p {
            font-size: 1.02rem;
            line-height: 1.9;
            color: var(--fiox-charcoal-soft);
            margin-bottom: 20px;
            text-align: justify;
            text-justify: inter-word;
            hyphens: auto;
        }

        .who-we-are p:last-child { margin-bottom: 0; }

        .who-we-are .side-stat-card {
            background: var(--fiox-bg);
            border: 1px solid var(--fiox-border);
            border-radius: 16px;
            padding: 32px 28px;
            height: 100%;
        }

        .who-we-are .side-stat-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .who-we-are .side-stat-card ul li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px dashed var(--fiox-border);
            font-size: 0.92rem;
            color: var(--fiox-charcoal-soft);
        }

        .who-we-are .side-stat-card ul li:last-child { border-bottom: none; }

        .who-we-are .side-stat-card ul li i {
            color: var(--fiox-amber-dark);
            font-size: 1.1rem;
            margin-top: 2px;
        }

        /* ================= VISION / MISSION ================= */
        .vm-section {
            padding: 0 0 10px;
        }

        .vm-card {
            border-radius: 18px;
            padding: 42px 38px;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .vm-card.vision {
            background: var(--fiox-charcoal);
        }

        .vm-card.mission {
            background: linear-gradient(135deg, var(--fiox-amber), var(--fiox-amber-dark));
        }

        .vm-card::before {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }

        .vm-card .vm-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.4rem;
            margin-bottom: 22px;
            position: relative;
        }

        .vm-card h3 {
            color: #fff;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 14px;
            position: relative;
        }

        .vm-card p {
            color: rgba(255,255,255,0.85);
            font-size: 0.98rem;
            line-height: 1.85;
            margin: 0;
            position: relative;
        }

        /* ================= WHY CHOOSE FIOX ================= */
        .why-section {
            padding: 70px 0;
            background: #fff; /* var(--fiox-bg); */
        }

        .why-intro p {
            font-size: 1rem;
            line-height: 1.85;
            color: var(--fiox-charcoal-soft);
            max-width: 640px;
        }

        .value-card {
            background: #fff;
            border: 1px solid var(--fiox-border);
            border-radius: 14px;
            padding: 28px 22px;
            text-align: center;
            height: 100%;
            transition: all 0.25s ease;
        }

        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 30px rgba(184, 121, 31, 0.14);
            border-color: transparent;
        }

        .value-card .value-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: rgba(184, 121, 31, 0.1);
            color: var(--fiox-amber-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 16px;
            transition: all 0.25s ease;
        }

        .value-card:hover .value-icon {
            background: linear-gradient(135deg, var(--fiox-amber), var(--fiox-amber-dark));
            color: #fff;
        }

        .value-card h4 {
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--fiox-charcoal);
            margin: 0;
        }

        @media (max-width: 767px) {
            .page-banner { padding: 60px 0; }
            .page-banner h1 { font-size: 1.9rem; }
            .page-banner .banner-subtext { font-size: 0.95rem; margin-top: 14px; }
            .who-we-are { padding: 70px 0 50px; }
            .who-we-are p { text-align: left; }
            .section-title { font-size: 1.9rem; }
            .vm-card { padding: 32px 26px; margin-bottom: 20px; }
            .why-section { padding: 70px 0; }
        }
    </style>
</head>
<body>

    <!-- ================= PAGE BANNER ================= -->
    <section class="page-banner">
        <div class="section-wrap">
            <h1>About FIOX Global Composites</h1>
            <p class="banner-subtext">
                Advanced Glass Fiber Reinforced Polymer (GFRP) reinforcement solutions for construction, infrastructure, industrial and specialized applications.
            </p>
        </div>
    </section>

    <!-- ================= WHO WE ARE ================= -->
    <section class="who-we-are">
        <div class="section-wrap">
            <div class="row g-5 align-items-start">
                <div class="col-lg-7">
                    <div class="who-we-are-tag">
                        <div class="brand-mark"><i class="bi bi-buildings"></i></div>
                        <div class="section-tag">Who We Are</div>
                    </div>
                    <h2 class="section-title mb-4">Engineering the Future with Composites</h2>

                    <p>
                        FIOX Global Composites is specialized in advanced Fiber Reinforced Polymer (FRP)
                        reinforcement solutions for modern construction, infrastructure, industrial and
                        specialized engineering applications.
                    </p>
                    <p>
                        Our FRP products are designed as a durable alternative to conventional reinforcement,
                        especially in environments where corrosion, moisture, chemicals, electrical conductivity
                        and long-term maintenance are critical concerns.
                    </p>
                    <p>
                        With high strength, low weight, corrosion resistance and non-conductive properties,
                        FRP reinforcement offers dependable performance across demanding applications. By
                        combining quality raw materials, controlled manufacturing processes and
                        engineering-focused development, FIOX delivers consistent and reliable solutions
                        designed for long service life.
                    </p>
                    <p>
                        Our focus is on supporting the evolving needs of the global construction industry with
                        innovative composite materials that enable durable, efficient and future-ready
                        infrastructure.
                    </p>
                </div>

                <div class="col-lg-5">
                    <div class="side-stat-card">
                        <h5 class="fw-bold mb-3" style="color: var(--fiox-charcoal);">What Sets Us Apart</h5>
                        <ul>
                            <li><i class="bi bi-shield-check"></i> Corrosion-resistant &amp; non-conductive FRP solutions</li>
                            <li><i class="bi bi-gem"></i> Quality-focused products & reliable solutions.</li>
                            <li><i class="bi bi-diagram-3"></i> Application focused GFRP solutions</li>
                            <li><i class="bi bi-globe-americas"></i> Built for the evolving global construction industry</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= VISION / MISSION ================= -->
    <section class="vm-section">
        <div class="section-wrap">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="vm-card vision">
                        <div class="vm-icon"><i class="bi bi-eye"></i></div>
                        <h3>Our Vision</h3>
                        <p>
                            To become a globally trusted leader in advanced composite solutions,
                            transforming the way industries build with materials that are stronger,
                            lighter, longer-lasting and sustainable.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vm-card mission">
                        <div class="vm-icon"><i class="bi bi-bullseye"></i></div>
                        <h3>Our Mission</h3>
                        <p>
                            To deliver innovative, high-quality composite products that provide superior
                            performance, durability and value to our customers &mdash; while continuously
                            advancing technology, manufacturing excellence and sustainable solutions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= WHY CHOOSE FIOX ================= -->
    <section class="why-section">
        <div class="section-wrap">
            <div class="row align-items-end mb-5">
                <div class="col-lg-7 why-intro">
                    <div class="section-tag">Why Choose FIOX</div>
                    <h2 class="section-title mb-3">The Values That Guide Us</h2>
                    <p>
                        At FIOX Global Composites, our values guide the way we develop products,
                        serve customers and build long-term relationships.
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-award"></i></div>
                        <h4>Quality</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-lightbulb"></i></div>
                        <h4>Innovation</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                        <h4>Integrity</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-people"></i></div>
                        <h4>Customer Focus</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-hourglass-split"></i></div>
                        <h4>Durability</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-gear"></i></div>
                        <h4>Engineering Excellence</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-recycle"></i></div>
                        <h4>Sustainability</h4>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="value-card">
                        <div class="value-icon"><i class="bi bi-check-circle"></i></div>
                        <h4>Reliability</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection