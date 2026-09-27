@extends('header')

@section('content')

<style>
    .ad-page {
        background: #fff;/* var(--fiox-bg); */
    }

    .ad-wrap {
        max-width: 1240px;
        margin: 0 auto;
        padding: 56px 32px 80px;
    }

    /* ===== BREADCRUMB ===== */
    .ad-crumb {
        font-size: 0.84rem;
        color: var(--fiox-charcoal-soft);
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ad-crumb a {
        color: var(--fiox-charcoal-soft);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .ad-crumb a:hover {
        color: var(--fiox-amber-dark);
    }

    .ad-crumb .sep {
        color: #cfc6b6;
        font-size: 0.7rem;
    }

    .ad-crumb .current {
        color: var(--fiox-amber-dark);
        font-weight: 600;
    }

    /* =========================================================
       APPLICATION NAME — PREMIUM HEADING
       eyebrow tag + large title + amber gradient accent stroke
       + soft rotated corner ornament, on off-white plate
       ========================================================= */
    .ad-heading {
        position: relative;
        margin: 0 0 48px;
        padding: 38px 40px 34px;
        background: #fff;
        border: 1px solid var(--fiox-border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(47,47,48,0.04), 0 26px 50px -30px rgba(47,47,48,0.22);
        animation: adReveal 0.6s ease both;
    }

    .ad-heading::before {
        /* rotated square ornament, top-right */
        content: '';
        position: absolute;
        top: -46px;
        right: -46px;
        width: 140px;
        height: 140px;
        border-radius: 28px;
        background: linear-gradient(135deg, var(--fiox-amber) 0%, var(--fiox-amber-dark, #9c6519) 100%);
        opacity: 0.08;
        transform: rotate(24deg);
        pointer-events: none;
    }

    .ad-heading::after {
        /* thin sweeping baseline under the whole card */
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--fiox-amber) 0%, var(--fiox-amber) 30%, transparent 100%);
    }

    .ad-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--fiox-amber-dark, #9c6519);
        margin-bottom: 14px;
    }

    .ad-eyebrow::before {
        content: '';
        display: inline-block;
        width: 30px;
        height: 2px;
        background: var(--fiox-amber);
        border-radius: 2px;
    }

    .ad-title {
        position: relative;
        display: block;
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        line-height: 1.2;
        letter-spacing: -0.015em;
        color: var(--fiox-charcoal);
        margin: 0;
        padding-left: 22px;
        border-left: 5px solid var(--fiox-amber);
    }

    .ad-title .accent {
        background: linear-gradient(100deg, var(--fiox-amber-dark, #9c6519) 0%, var(--fiox-amber) 55%, var(--fiox-amber-dark, #9c6519) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    @media (prefers-reduced-motion: reduce) {
        .ad-heading {
            animation: none;
        }
    }

    /* ===== PAGE REVEAL ===== */
    @keyframes adReveal {
        from { opacity: 0; filter: blur(10px); }
        to { opacity: 1; filter: blur(0); }
    }

    .ad-use-row {
        animation: adReveal 0.55s ease both;
    }

    .ad-use-row {
        animation-delay: 0.08s;
    }

    @media (prefers-reduced-motion: reduce) {
        .ad-use-row {
            animation: none;
        }
    }

    /* ===== USE ROWS: image 40% / description 60% ===== */
    .ad-use-list {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .ad-use-row {
        display: grid;
        grid-template-columns: 40% 60%;
        gap: 40px;
        align-items: start;
        padding-bottom: 40px;
        border-bottom: 1px solid var(--fiox-border);
    }

    .ad-use-list .ad-use-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .ad-use-image {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 1px 2px rgba(47,47,48,0.04), 0 20px 40px -20px rgba(47,47,48,0.18);
        padding: 0px; /* remove padding to make image full width */
        border-top: 4px solid var(--fiox-amber);
        border-bottom: 4px solid #C7C7C7;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .ad-use-image:hover {
        box-shadow: 0 1px 2px rgba(47,47,48,0.04), 0 28px 54px -18px rgba(231, 184, 101, 0.38);
        transform: translateY(-3px);
    }

    .ad-use-image .img-frame {
        aspect-ratio: 4 / 3;
        border-radius: 8px;
        overflow: hidden;
        background: #fdfcfa;
    }

    .ad-use-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .ad-use-image:hover img {
        transform: scale(1.04);
    }

    /* ---- RIGHT: DESCRIPTION ---- */
    .ad-use-details h4 {
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        font-weight: 600;
        color: var(--fiox-charcoal);
        font-size: 1.15rem;
        margin: 0 0 14px;
    }

    /* Rendered Quill/HTML description content — base text 16px */
    .ad-use-details .ad-desc-content {
        font-size: 16px;
        line-height: 1.8;
        color: var(--fiox-charcoal-soft);
        max-width: 62ch;
    }

    .ad-use-details .ad-desc-content p {
        font-size: 16px;
        line-height: 1.8;
        color: var(--fiox-charcoal-soft);
        margin: 0 0 14px;
    }

    .ad-use-details .ad-desc-content p:last-child {
        margin-bottom: 0;
    }

    .ad-use-details .ad-desc-content h1,
    .ad-use-details .ad-desc-content h2,
    .ad-use-details .ad-desc-content h3 {
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        font-weight: 600;
        color: var(--fiox-charcoal);
        line-height: 1.4;
        margin: 18px 0 10px;
    }

    .ad-use-details .ad-desc-content h1 { font-size: 1.25rem; }
    .ad-use-details .ad-desc-content h2 { font-size: 1.15rem; }
    .ad-use-details .ad-desc-content h3 { font-size: 1.05rem; }

    .ad-use-details .ad-desc-content strong,
    .ad-use-details .ad-desc-content b {
        color: var(--fiox-charcoal);
        font-weight: 600;
    }

    .ad-use-details .ad-desc-content em,
    .ad-use-details .ad-desc-content i {
        font-style: italic;
    }

    .ad-use-details .ad-desc-content a {
        color: var(--fiox-amber-dark, #9c6519);
        text-decoration: underline;
        text-underline-offset: 2px;
    }

    .ad-use-details .ad-desc-content a:hover {
        color: var(--fiox-amber);
    }

    .ad-use-details .ad-desc-content ul,
    .ad-use-details .ad-desc-content ol {
        margin: 0 0 14px;
        padding-left: 22px;
    }

    .ad-use-details .ad-desc-content ul li,
    .ad-use-details .ad-desc-content ol li {
        font-size: 16px;
        line-height: 1.8;
        color: var(--fiox-charcoal-soft);
        margin-bottom: 6px;
    }

    .ad-use-details .ad-desc-content ul li::marker {
        color: var(--fiox-amber);
    }

    .ad-use-details .ad-desc-content ol li::marker {
        color: var(--fiox-amber-dark, #9c6519);
        font-weight: 600;
    }

    .ad-use-details .ad-desc-content blockquote {
        margin: 14px 0;
        padding: 10px 16px;
        border-left: 3px solid var(--fiox-amber);
        background: var(--fiox-bg);
        color: var(--fiox-charcoal-soft);
        font-size: 16px;
        line-height: 1.8;
    }

    .ad-use-details .ad-desc-content img {
        max-width: 100%;
        border-radius: 8px;
        margin: 10px 0;
    }

    /* ===== EMPTY STATE ===== */
    .ad-empty {
        text-align: center;
        padding: 60px 20px;
        color: var(--fiox-charcoal-soft);
    }

    .ad-empty i {
        font-size: 2.2rem;
        color: var(--fiox-amber);
        display: block;
        margin-bottom: 12px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
        .ad-use-row {
            grid-template-columns: 1fr;
            gap: 22px;
        }

        .ad-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .ad-wrap {
            padding: 36px 18px 56px;
        }

        .ad-heading {
            padding: 28px 22px 26px;
            border-radius: 14px;
        }

        .ad-title {
            font-size: 1.55rem;
            padding-left: 14px;
            border-left-width: 4px;
        }

        .ad-use-details .ad-desc-content,
        .ad-use-details .ad-desc-content p,
        .ad-use-details .ad-desc-content ul li,
        .ad-use-details .ad-desc-content ol li {
            font-size: 16px;
        }
    }
</style>

<div class="ad-page">
    <div class="ad-wrap">

        <div class="ad-heading">
            <h1 class="ad-title"><span class="accent">{{ $application->name }}</span></h1>
        </div>

        @if ($application->images->count() > 0)
            <div class="ad-use-list">
                @foreach ($application->images as $use)
                    <div class="ad-use-row">
                        <div class="ad-use-image">
                            <div class="img-frame">
                                <img src="{{ asset('application/' . $use->image) }}" alt="{{ $use->title }}">
                            </div>
                        </div>
                        <div class="ad-use-details">
                            @if ($use->title)
                                <h4>{{ $use->title }}</h4>
                            @endif
                            <div class="ad-desc-content">
                                {!! $use->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="ad-empty">
                <i class="bi bi-diagram-3"></i>
                <p class="mb-0">No use cases have been added for this application yet.</p>
            </div>
        @endif

    </div>
</div>

@endsection