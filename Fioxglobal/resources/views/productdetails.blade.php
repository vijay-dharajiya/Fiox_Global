@extends('header')

@section('content')

<style>
    .pd-page { background: white; }

    .pd-wrap {
        max-width: 1240px;
        margin: 0 auto;
        padding: 56px 32px 80px;
    }

    /* ===== BREADCRUMB ===== */
    .pd-crumb {
        font-size: 0.84rem;
        color: var(--fiox-charcoal-soft);
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .pd-crumb a { color: var(--fiox-charcoal-soft); text-decoration: none; transition: color 0.2s ease; }
    .pd-crumb a:hover { color: var(--fiox-amber-dark); }
    .pd-crumb .sep { color: #cfc6b6; font-size: 0.7rem; }
    .pd-crumb .current { color: var(--fiox-amber-dark); font-weight: 600; }

    /* =========================================================
       PRODUCT NAME — PREMIUM HEADING
       ========================================================= */
    .pd-heading {
        position: relative;
        margin: 0 0 40px;
        padding: 38px 40px 34px;
        background: #fff;
        border: 1px solid var(--fiox-border);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(47,47,48,0.04), 0 26px 50px -30px rgba(47,47,48,0.22);
        animation: pdReveal 0.6s ease both;
    }

    .pd-heading::before {
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

    .pd-heading::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--fiox-amber) 0%, var(--fiox-amber) 30%, transparent 100%);
    }

    .pd-eyebrow {
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
    .pd-eyebrow::before {
        content: '';
        display: inline-block;
        width: 30px;
        height: 2px;
        background: var(--fiox-amber);
        border-radius: 2px;
    }

    .pd-title {
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

    .pd-title .accent {
        background: linear-gradient(100deg, var(--fiox-amber-dark, #9c6519) 0%, var(--fiox-amber) 55%, var(--fiox-amber-dark, #9c6519) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .pd-subline {
        position: relative;
        z-index: 1;
        margin-top: 16px;
        padding-left: 22px;
        font-size: 0.94rem;
        color: var(--fiox-charcoal-soft);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pd-availability { display: inline-flex; align-items: center; gap: 6px; font-weight: 600; }

    .pd-availability .dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #2e8b57;
        display: inline-block;
        box-shadow: 0 0 0 0 rgba(46, 139, 87, 0.5);
        animation: pdPulseDot 1.8s ease-out infinite;
    }

    @keyframes pdPulseDot {
        0%   { box-shadow: 0 0 0 0 rgba(46, 139, 87, 0.45); }
        70%  { box-shadow: 0 0 0 8px rgba(46, 139, 87, 0); }
        100% { box-shadow: 0 0 0 0 rgba(46, 139, 87, 0); }
    }

    .pd-availability.is-inactive .dot { background: #b0473c; animation: none; box-shadow: none; }

    /* ===== PAGE REVEAL (fade + blur on load) ===== */
    @keyframes pdReveal {
        from { opacity: 0; filter: blur(10px); }
        to   { opacity: 1; filter: blur(0); }
    }

    .pd-grid {
        animation: pdReveal 0.55s ease both;
        animation-delay: 0.08s;
    }

    /* ===== CLICK BLUR-PULSE EFFECT ===== */
    @keyframes pdClickBlur {
        0%   { filter: blur(0); }
        35%  { filter: blur(6px); }
        100% { filter: blur(0); }
    }
    .pd-click-blur { animation: pdClickBlur 0.5s ease; }

    @media (prefers-reduced-motion: reduce) {
        .pd-heading,
        .pd-grid,
        .pd-availability .dot,
        .pd-click-blur { animation: none; }
    }

    /* ===== TWO COLUMN: 40 / 60 (gap comes out of the columns, no overflow) ===== */
    .pd-grid {
        display: grid;
        grid-template-columns: minmax(0, 40fr) minmax(0, 60fr);
        gap: 56px;
        align-items: start;
        width: 100%;
    }

    /* ---- LEFT: IMAGE PANEL / AUTO SLIDER ---- */
    .pd-image-panel {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 1px 2px rgba(47,47,48,0.04), 0 20px 40px -20px rgba(47,47,48,0.18);
        padding: 0px;
        border-top: 4px solid var(--fiox-amber);
        border-bottom: 4px solid #C7C7C7;
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .pd-image-panel:hover {
        box-shadow: 0 1px 2px rgba(47,47,48,0.04), 0 28px 54px -18px rgba(231, 184, 101, 0.38);
        transform: translateY(-3px);
    }

    .pd-main-image {
        position: relative;
        aspect-ratio: 1 / 1;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fdfcfa;
        cursor: pointer;
    }

    .pd-main-image img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        opacity: 1;
        transform: scale(1);
        transition: opacity 0.5s ease, transform 0.5s ease, filter 0.4s ease;
    }

    .pd-main-image img.is-fading { opacity: 0; transform: scale(1.04); }
    .pd-image-panel:hover .pd-main-image img { transform: scale(1.045); }

    .pd-slider-dots {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 12px;
        display: flex;
        justify-content: center;
        gap: 7px;
        z-index: 2;
    }

    .pd-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.65);
        border: 1px solid rgba(47, 47, 48, 0.25);
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease, width 0.25s ease;
    }

    .pd-dot.active {
        background: var(--fiox-amber);
        border-color: var(--fiox-amber-dark);
        width: 18px;
        border-radius: 4px;
    }

    .pd-thumb-strip {
        display: flex;
        gap: 10px;
        margin-top: 16px;
        overflow-x: auto;
        padding-bottom: 2px;
    }

    .pd-thumb {
        flex: 0 0 auto;
        width: 64px;
        height: 64px;
        border-radius: 7px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        outline: 1px solid var(--fiox-border);
        outline-offset: -1px;
        transition: outline-color 0.2s ease, border-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    .pd-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .pd-thumb:hover img { transform: scale(1.12); }

    .pd-thumb.active,
    .pd-thumb:hover {
        border-color: var(--fiox-amber);
        outline-color: transparent;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px -8px rgba(231, 184, 101, 0.55);
    }

    /* ---- RIGHT: DESCRIPTION (flat, no card) ---- */
    .pd-details {
        min-width: 0;
        width: 100%;
        overflow-wrap: anywhere;
    }

    .pd-details h2,
    .pd-details h3 {
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        font-weight: 600;
        color: var(--fiox-charcoal);
        margin: 28px 0 12px;
        font-size: 1.15rem;
    }

    .pd-details > *:first-child { margin-top: 0; }

    .pd-details p {
        font-size: 18px;
        line-height: 1.8;
        color: var(--fiox-charcoal-soft);
        margin: 0 0 16px;
        max-width: 100%;
    }

    .pd-details ul {
        margin: 0 0 20px;
        padding: 0;
        list-style: none;
    }

    .pd-details ul li {
        position: relative;
        padding-left: 22px;
        font-size: 18px;
        line-height: 1.65;
        color: var(--fiox-charcoal-soft);
        margin-bottom: 11px;
        max-width: 100%;
        transition: color 0.2s ease, padding-left 0.2s ease;
    }

    .pd-details ul li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.65em;
        width: 7px;
        height: 7px;
        background: var(--fiox-amber);
        border-radius: 50%;
        transition: box-shadow 0.2s ease;
    }

    .pd-details ul li:hover { color: var(--fiox-charcoal); padding-left: 26px; }
    .pd-details ul li:hover::before { box-shadow: 0 0 0 5px rgba(231, 184, 101, 0.3); }

    .pd-details strong { color: var(--fiox-charcoal); font-weight: 600; }

    /* guards against wide content coming from the admin editor */
    .pd-details img,
    .pd-details table,
    .pd-details iframe {
        max-width: 100%;
        height: auto;
    }

    .pd-details table {
        display: block;
        overflow-x: auto;
    }

    /* ---- CTA ---- */
    .pd-cta-row {
        margin-top: 36px;
        padding-top: 28px;
        border-top: 1px solid var(--fiox-border);
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .pd-btn-primary {
        position: relative;
        overflow: hidden;
        background: var(--fiox-amber);
        color: #fff;
        border: none;
        padding: 14px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.94rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 9px;
        transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    .pd-btn-primary::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle, rgba(255,255,255,0.35), transparent 60%);
        opacity: 0;
        transform: scale(0.6);
        transition: opacity 0.4s ease, transform 0.4s ease;
    }

    .pd-btn-primary:hover {
        background: var(--fiox-amber-dark);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 26px -12px rgba(231, 184, 101, 0.65);
    }

    .pd-btn-primary:hover::after { opacity: 1; transform: scale(1); }
    .pd-btn-primary:active { transform: translateY(0) scale(0.98); }

    /* =====================================================
       ADVANTAGES CARD (golden theme + animated border)
       ===================================================== */
    @property --pd-angle {
        syntax: '<angle>';
        inherits: false;
        initial-value: 0deg;
    }

    @keyframes pdSpinBorder { to { --pd-angle: 360deg; } }

    .pd-adv-section { margin-top: 72px; }

    .pd-adv-card {
        position: relative;
        border-radius: 24px;
        padding: 3px;
        background: linear-gradient(135deg, #E7B865, var(--fiox-amber), #f6dfa8, var(--fiox-amber-dark));
        background: conic-gradient(
            from var(--pd-angle),
            var(--fiox-amber-dark),
            #f6dfa8 20%,
            #E7B865 35%,
            rgba(231, 184, 101, 0.15) 55%,
            var(--fiox-amber) 75%,
            var(--fiox-amber-dark)
        );
        animation: pdSpinBorder 6s linear infinite;
        box-shadow: 0 30px 60px -30px rgba(184, 121, 31, 0.45);
        transition: transform 0.4s cubic-bezier(.22, 1, .36, 1), box-shadow 0.4s ease;
    }

    .pd-adv-card::before {
        content: '';
        position: absolute;
        inset: -14px;
        border-radius: 32px;
        background: conic-gradient(from var(--pd-angle), var(--fiox-amber), #f6dfa8, var(--fiox-amber));
        filter: blur(30px);
        opacity: 0.22;
        z-index: -1;
        transition: opacity 0.4s ease;
    }

    .pd-adv-card:hover { transform: translateY(-6px); box-shadow: 0 40px 70px -30px rgba(184, 121, 31, 0.6); }
    .pd-adv-card:hover::before { opacity: 0.45; }

    .pd-adv-inner {
        position: relative;
        overflow: hidden;
        border-radius: 21px;
        padding: 44px 48px 40px;
        background:
            radial-gradient(circle at 100% 0%, rgba(231, 184, 101, 0.28), transparent 45%),
            radial-gradient(circle at 0% 100%, rgba(184, 121, 31, 0.10), transparent 45%),
            linear-gradient(180deg, #fffdf7 0%, #fbf3e1 100%);
    }

    .pd-adv-inner::after {
        content: '';
        position: absolute;
        top: 0;
        left: -60%;
        width: 40%;
        height: 100%;
        background: linear-gradient(100deg, transparent, rgba(255, 255, 255, 0.55), transparent);
        transform: skewX(-18deg);
        transition: left 0.9s ease;
        pointer-events: none;
    }

    .pd-adv-card:hover .pd-adv-inner::after { left: 130%; }

    .pd-adv-head {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
        padding-bottom: 16px;
        border-bottom: 1px dashed rgba(184, 121, 31, 0.35);
    }

    .pd-adv-icon {
        flex: 0 0 auto;
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        line-height: 1;
        color: #fff;
        background: linear-gradient(135deg, #E7B865, var(--fiox-amber-dark));
        box-shadow: 0 12px 22px -10px rgba(184, 121, 31, 0.8), inset 0 1px 0 rgba(255, 255, 255, 0.45);
    }

    .pd-adv-icon i { display: block; line-height: 1; }

    .pd-adv-head-text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-height: 56px;
    }

    .pd-adv-eyebrow {
        display: block;
        font-size: 1.80rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--fiox-amber-dark);
        margin: 0;
        line-height: 1.15;
    }

    .pd-adv-title {
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        font-weight: 700;
        font-size: 1.7rem;
        line-height: 1.2;
        color: var(--fiox-charcoal);
        margin: 0;
    }

    .pd-adv-body { position: relative; z-index: 1; }

    .pd-adv-body ul,
    .pd-adv-body ol {
        list-style: none;
        margin: 0;
        padding: 0;
        columns: 2;
        column-gap: 40px;
    }

    .pd-adv-body li {
        position: relative;
        break-inside: avoid;
        padding: 14px 16px 14px 58px;
        margin: 0 0 12px;
        font-size: 17px;
        line-height: 1.55;
        color: var(--fiox-charcoal);
        background: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(184, 121, 31, 0.22);
        border-radius: 14px;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease, background 0.25s ease;
    }

    .pd-adv-body li::before {
        content: '\2713';
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, #E7B865, var(--fiox-amber-dark));
        box-shadow: 0 6px 12px -6px rgba(184, 121, 31, 0.9);
    }

    .pd-adv-body li:hover {
        transform: translateX(6px);
        background: #fff;
        border-color: var(--fiox-amber);
        box-shadow: 0 14px 26px -16px rgba(184, 121, 31, 0.6);
    }

    .pd-adv-body p {
        font-size: 17px;
        line-height: 1.7;
        color: var(--fiox-charcoal-soft);
        margin: 0 0 12px;
    }

    .pd-adv-body h2,
    .pd-adv-body h3 {
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--fiox-amber-dark);
        margin: 0 0 14px;
    }

    .pd-adv-body strong { font-weight: 600; }

    /* =====================================================
       COMPARISON SECTION
       ===================================================== */
    .pd-compare-head { text-align: center; margin-bottom: 44px; }

    .pd-compare-eyebrow {
        display: inline-block;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--fiox-amber-dark);
        background: rgba(231, 184, 101, 0.22);
        padding: 6px 16px;
        border-radius: 999px;
        margin-bottom: 14px;
    }

    .pd-compare-title {
        font-family: 'Poppins', 'Segoe UI', sans-serif;
        font-weight: 700;
        font-size: 2.3rem;
        color: var(--fiox-charcoal);
        margin: 0;
    }

    .pd-compare-title::after {
        content: '';
        display: block;
        width: 84px;
        height: 4px;
        margin: 16px auto 0;
        border-radius: 4px;
        background: linear-gradient(90deg, #E7B865, var(--fiox-amber-dark));
    }

    .pd-compare-sub {
        margin: 18px auto 0;
        max-width: 560px;
        font-size: 1rem;
        line-height: 1.6;
        color: var(--fiox-charcoal-soft);
    }

    .pd-compare-list {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 32px;
    }

    .pd-compare-item {
        position: relative;
        width: 60%;
        max-width: 60%;
        margin: 0 auto;
        border-radius: 24px;
        padding: 3px;
        background: linear-gradient(135deg, #E7B865, #f6dfa8 40%, var(--fiox-amber) 70%, var(--fiox-amber-dark));
        box-shadow: 0 30px 60px -30px rgba(184, 121, 31, 0.45);
        cursor: zoom-in;
        opacity: 0;
        transform: translateY(34px);
        transition: opacity 0.7s ease, transform 0.7s cubic-bezier(.22, 1, .36, 1);
    }

    .pd-compare-item.is-visible { opacity: 1; transform: translateY(0); }

    .pd-compare-frame {
        position: relative;
        overflow: hidden;
        border-radius: 21px;
        background: #fff;
    }

    .pd-compare-frame img { display: block; width: 100%; height: auto; }

    .pd-compare-chip,
    .pd-compare-zoom {
        position: absolute;
        top: 16px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #fff;
        background: rgba(47, 47, 48, 0.78);
        backdrop-filter: blur(6px);
        padding: 7px 14px;
        border-radius: 999px;
    }

    .pd-compare-chip { left: 16px; background: linear-gradient(135deg, #E7B865, var(--fiox-amber-dark)); }

    .pd-compare-zoom { right: 16px; opacity: 0; transition: opacity 0.25s ease; }
    .pd-compare-item:hover .pd-compare-zoom { opacity: 1; }

    /* ===== FULL-SCREEN LIGHTBOX ===== */
    .pd-lightbox {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        background: rgba(20, 18, 14, 0.94);
        overflow: auto;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        cursor: zoom-out;
    }

    .pd-lightbox.open { opacity: 1; visibility: visible; }

    .pd-lightbox img {
        margin: auto;
        max-width: 100vw;
        max-height: 100vh;
        width: auto;
        height: auto;
        object-fit: contain;
        padding: 20px;
        transform: scale(0.96);
        transition: transform 0.3s ease, opacity 0.2s ease;
    }

    .pd-lightbox.open img { transform: scale(1); }

    .pd-lightbox-close,
    .pd-lightbox-nav {
        position: fixed;
        z-index: 2;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.25);
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .pd-lightbox-close { top: 18px; right: 22px; }
    .pd-lightbox-close:hover { background: var(--fiox-amber); transform: rotate(90deg); }

    .pd-lightbox-nav { top: 50%; margin-top: -23px; }
    .pd-lightbox-nav.prev { left: 22px; }
    .pd-lightbox-nav.next { right: 22px; }
    .pd-lightbox-nav:hover { background: var(--fiox-amber); }
    .pd-lightbox-nav.is-hidden { display: none; }

    .pd-lightbox-count {
        position: fixed;
        left: 50%;
        bottom: 20px;
        transform: translateX(-50%);
        z-index: 2;
        font-size: 0.85rem;
        font-weight: 600;
        color: #fff;
        background: rgba(255, 255, 255, 0.14);
        padding: 6px 16px;
        border-radius: 999px;
        pointer-events: none;
    }

    .pd-lightbox-count.is-hidden { display: none; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
        .pd-grid { grid-template-columns: minmax(0, 1fr); gap: 36px; }
        .pd-title { font-size: 2rem; }
        .pd-adv-section { margin-top: 52px; }
        .pd-adv-inner { padding: 32px 22px 26px; }
        .pd-adv-body ul,
        .pd-adv-body ol { columns: 1; }
        .pd-compare-head { margin-bottom: 32px; }
        .pd-compare-title { font-size: 1.8rem; }
        .pd-compare-list { gap: 24px; }
        .pd-compare-item { width: 85%; max-width: 85%; }

        .pd-lightbox img {
            max-width: none;
            max-height: none;
            width: 220vw;
        }
    }

    @media (max-width: 480px) {
        .pd-wrap { padding: 36px 18px 56px; }
        .pd-heading { padding: 28px 22px 26px; border-radius: 14px; }
        .pd-title { font-size: 1.55rem; padding-left: 14px; border-left-width: 4px; }
        .pd-subline { padding-left: 14px; }
        .pd-image-panel { padding: 14px; }
        .pd-adv-title { font-size: 1.35rem; }
        .pd-adv-icon { width: 46px; height: 46px; font-size: 1.3rem; }
        .pd-adv-head-text { min-height: 46px; }
        .pd-compare-item { width: 100%; max-width: 100%; }
        .pd-compare-zoom { display: none; }
        .pd-lightbox-nav { width: 40px; height: 40px; }
        .pd-lightbox-nav.prev { left: 10px; }
        .pd-lightbox-nav.next { right: 10px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .pd-adv-card { animation: none; }
        .pd-compare-item { opacity: 1; transform: none; transition: none; }
    }
</style>

@php
    $hasAdvantages = trim(strip_tags($product->advantages ?? '')) !== '';
    $hasComparison = $product->comparisonImages->count() > 0;
@endphp

<div class="pd-page">
    <div class="pd-wrap">

        <div class="pd-heading">
            <h1 class="pd-title"><span class="accent">{{ $product->name }}</span></h1>
        </div>

        <div class="pd-grid">

            <!-- LEFT 40%: IMAGE PANEL / AUTO SLIDER -->
            <div class="pd-image-panel">
                <div class="pd-main-image" id="pdMainImageWrap">
                    <img src="{{ asset('product/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         id="pdMainImage">

                    @if ($product->images->count() > 0)
                        <div class="pd-slider-dots" id="pdSliderDots"></div>
                    @endif
                </div>

                @if ($product->images->count() > 0)
                    <div class="pd-thumb-strip" id="pdThumbStrip">
                        <div class="pd-thumb active" data-full="{{ asset('product/' . $product->image) }}">
                            <img src="{{ asset('product/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                        @foreach ($product->images as $img)
                            <div class="pd-thumb" data-full="{{ asset('product/' . $img->image) }}">
                                <img src="{{ asset('product/' . $img->image) }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- RIGHT 60%: DESCRIPTION -->
            <div class="pd-details">
                {!! $product->description !!}

                <div class="pd-cta-row">
                    <a href="{{ route('contact_us') }}" class="pd-btn-primary">
                        <i class="bi bi-envelope"></i> Enquire Now
                    </a>
                </div>
            </div>

        </div>

        <!-- ADVANTAGES (golden animated-border card) -->
        @if ($hasAdvantages)
            <section class="pd-adv-section">
                <div class="pd-adv-card">
                    <div class="pd-adv-inner">
                        <div class="pd-adv-head">
                            <div class="pd-adv-icon"><i class="bi bi-patch-check-fill"></i></div>
                            <div class="pd-adv-head-text">
                                <h2 class="pd-adv-eyebrow">
                                    WHY CHOOSE THIS PRODUCT
                                </h2>
                            </div>
                        </div>

                        <div class="pd-adv-body">
                            {!! $product->advantages !!}
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- COMPARISON (click = full screen) -->
        @if ($hasComparison)
            <section class="pd-adv-section">
                <div class="pd-compare-head">
                    <span class="pd-compare-eyebrow">Side by side</span>
                    <h2 class="pd-compare-title">COMPARISON</h2>
                    <p class="pd-compare-sub">Compare GFRP and steel reinforcement side by side. Click any table to view it in full screen.</p>
                </div>

                <div class="pd-compare-list">
                    @foreach ($product->comparisonImages as $cmp)
                        <div class="pd-compare-item" data-full="{{ asset('product/' . $cmp->image) }}">

                            <span class="pd-compare-zoom"><i class="bi bi-arrows-fullscreen"></i> View full screen</span>

                            <div class="pd-compare-frame">
                                <img src="{{ asset('product/' . $cmp->image) }}"
                                     alt="{{ $product->name }} comparison {{ $loop->iteration }}"
                                     loading="lazy">
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>

    @if ($hasComparison)
        <!-- FULL-SCREEN LIGHTBOX -->
        <div class="pd-lightbox" id="pdLightbox" aria-hidden="true">
            <button type="button" class="pd-lightbox-close" id="pdLightboxClose" aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
            <button type="button" class="pd-lightbox-nav prev" id="pdLightboxPrev" aria-label="Previous image">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button type="button" class="pd-lightbox-nav next" id="pdLightboxNext" aria-label="Next image">
                <i class="bi bi-chevron-right"></i>
            </button>
            <img src="" alt="Comparison full screen" id="pdLightboxImg">
            <div class="pd-lightbox-count" id="pdLightboxCount"></div>
        </div>
    @endif
</div>

<script>
    (function () {
        var mainImage   = document.getElementById('pdMainImage');
        var mainWrap    = document.getElementById('pdMainImageWrap');
        var thumbStrip  = document.getElementById('pdThumbStrip');
        var dotsWrap    = document.getElementById('pdSliderDots');

        if (!mainImage) return;

        var thumbs = thumbStrip ? Array.prototype.slice.call(thumbStrip.querySelectorAll('.pd-thumb')) : [];
        var slides = thumbs.map(function (t) { return t.dataset.full; });

        var current = 0;
        var AUTOPLAY_DELAY = 3500;
        var timer = null;

        // Build dot indicators
        if (dotsWrap && slides.length > 1) {
            slides.forEach(function (src, i) {
                var dot = document.createElement('span');
                dot.className = 'pd-dot' + (i === 0 ? ' active' : '');
                dot.addEventListener('click', function (e) {
                    e.stopPropagation();
                    goToSlide(i);
                    restartAutoplay();
                });
                dotsWrap.appendChild(dot);
            });
        }

        var dotEls = dotsWrap ? Array.prototype.slice.call(dotsWrap.querySelectorAll('.pd-dot')) : [];

        function setActiveThumb(index) {
            thumbs.forEach(function (t, i) {
                t.classList.toggle('active', i === index);
            });
            dotEls.forEach(function (d, i) {
                d.classList.toggle('active', i === index);
            });
        }

        function goToSlide(index) {
            if (!slides.length || index === current) return;
            current = index;

            mainImage.classList.add('is-fading');
            setTimeout(function () {
                mainImage.src = slides[current];
                mainImage.classList.remove('is-fading');
            }, 250);

            setActiveThumb(current);
        }

        function nextSlide() {
            if (!slides.length) return;
            goToSlide((current + 1) % slides.length);
        }

        function startAutoplay() {
            if (slides.length > 1) {
                timer = setInterval(nextSlide, AUTOPLAY_DELAY);
            }
        }

        function stopAutoplay() {
            clearInterval(timer);
        }

        function restartAutoplay() {
            stopAutoplay();
            startAutoplay();
        }

        // Manual thumb click
        thumbs.forEach(function (thumb, i) {
            thumb.addEventListener('click', function () {
                goToSlide(i);
                restartAutoplay();
            });
        });

        // Pause auto slider while hovering the image panel
        mainWrap.addEventListener('mouseenter', stopAutoplay);
        mainWrap.addEventListener('mouseleave', startAutoplay);

        // Click-to-blur pulse effect on the main image
        mainWrap.addEventListener('click', function () {
            mainImage.classList.remove('pd-click-blur');
            void mainImage.offsetWidth;
            mainImage.classList.add('pd-click-blur');
        });

        // Click-to-blur pulse effect on the CTA button
        var ctaBtn = document.querySelector('.pd-btn-primary');
        if (ctaBtn) {
            ctaBtn.addEventListener('click', function () {
                var grid = document.querySelector('.pd-grid');
                grid.classList.remove('pd-click-blur');
                void grid.offsetWidth;
                grid.classList.add('pd-click-blur');
            });
        }

        startAutoplay();
    })();

    // ===== Comparison images: scroll reveal + full-screen lightbox =====
    (function () {
        var items = Array.prototype.slice.call(document.querySelectorAll('.pd-compare-item'));
        if (!items.length) return;

        // reveal on scroll
        if ('IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        io.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12 });

            items.forEach(function (el) { io.observe(el); });
        } else {
            items.forEach(function (el) { el.classList.add('is-visible'); });
        }

        // lightbox
        var box      = document.getElementById('pdLightbox');
        var boxImg   = document.getElementById('pdLightboxImg');
        var boxClose = document.getElementById('pdLightboxClose');
        var boxPrev  = document.getElementById('pdLightboxPrev');
        var boxNext  = document.getElementById('pdLightboxNext');
        var boxCount = document.getElementById('pdLightboxCount');

        var sources = items.map(function (el) { return el.dataset.full; });
        var index = 0;
        var multiple = sources.length > 1;

        if (!multiple) {
            boxPrev.classList.add('is-hidden');
            boxNext.classList.add('is-hidden');
            boxCount.classList.add('is-hidden');
        }

        function show(i) {
            index = (i + sources.length) % sources.length;
            boxImg.src = sources[index];
            boxCount.textContent = (index + 1) + ' / ' + sources.length;
        }

        function openBox(i) {
            show(i);
            box.classList.add('open');
            box.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeBox() {
            box.classList.remove('open');
            box.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        items.forEach(function (el, i) {
            el.addEventListener('click', function () {
                openBox(i);
            });
        });

        // click anywhere (dark area or image) closes
        box.addEventListener('click', closeBox);

        boxClose.addEventListener('click', function (e) {
            e.stopPropagation();
            closeBox();
        });

        boxPrev.addEventListener('click', function (e) {
            e.stopPropagation();
            show(index - 1);
        });

        boxNext.addEventListener('click', function (e) {
            e.stopPropagation();
            show(index + 1);
        });

        document.addEventListener('keydown', function (e) {
            if (!box.classList.contains('open')) return;

            if (e.key === 'Escape') closeBox();
            if (multiple && e.key === 'ArrowLeft') show(index - 1);
            if (multiple && e.key === 'ArrowRight') show(index + 1);
        });
    })();
</script>

@endsection