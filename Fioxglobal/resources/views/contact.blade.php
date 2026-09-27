@extends('header')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | FIOX Global Composites</title>
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
                linear-gradient(115deg, rgba(47,47,48,0.80) 0%, rgba(47,47,48,0.8) 50%, rgba(184,121,31,0.35) 100%),
                url('{{ asset("logo/bg-2.jpeg") }}') center/cover no-repeat;
            padding: 90px 0;
            text-align: center;
        }

        .page-banner .crumb {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 14px;
        }

        .page-banner .crumb a { color: var(--fiox-amber-light); text-decoration: none; }
        .page-banner .crumb i { font-size: 0.7rem; }

        .page-banner h1 {
            color: #fff;
            font-size: 2.6rem;
            font-weight: 800;
            margin: 0 0 12px;
        }

        .page-banner p {
            color: rgba(255,255,255,0.82);
            font-size: 1.02rem;
            max-width: 640px;
            margin: 0 auto;
            line-height: 1.75;
        }

        /* ================= CONTACT SECTION ================= */
        .contact-section {
            padding: 60px 0 67px;
        }

        .section-tag {
            color: var(--fiox-amber-dark);
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .section-title {
            color: var(--fiox-charcoal);
            font-size: 1.3rem;
            font-weight: 800;
        }

        /* ---- Contact info cards ---- */
        .info-card {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            background: var(--fiox-bg);
            border: 1px solid var(--fiox-border);
            border-radius: 14px;
            padding: 22px 20px;
            margin-bottom: 16px;
            transition: all 0.25s ease;
        }

        .info-card:hover {
            border-color: var(--fiox-amber);
            box-shadow: 0 10px 24px rgba(184, 121, 31, 0.1);
        }

        .info-card .info-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--fiox-amber), var(--fiox-amber-dark));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .info-card .info-label {
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--fiox-amber-dark);
            margin-bottom: 4px;
        }

        .info-card .info-value {
            font-size: 0.96rem;
            font-weight: 600;
            color: var(--fiox-charcoal);
            line-height: 1.5;
            margin: 0;
        }

        .info-card .info-value a {
            color: var(--fiox-charcoal);
            text-decoration: none;
        }

        .info-card .info-value a:hover {
            color: var(--fiox-amber-dark);
        }

        /* ---- Map ---- */
        .map-frame {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--fiox-border);
            height: 230px;
        }

        .map-frame iframe {
            width: 100%;
            height: 100%;
            border: 0;
            display: block;
        }

        /* ---- Form ---- */
        .contact-form-card {
            background: #fff;
            border: 1px solid var(--fiox-border);
            border-top: 4px solid var(--fiox-amber);
            border-bottom: 4px solid #C7C7C7;
            border-radius: 18px;
            padding: 44px 40px;
            box-shadow: 0 1px 2px rgba(47,47,48,0.04), 0 20px 40px -20px rgba(47,47,48,0.18);
            transition: box-shadow 0.3s ease, transform 0.3s ease, border-bottom-color 0.3s ease;
        }

        .contact-form-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 1px 2px rgba(47,47,48,0.04), 0 28px 54px -18px rgba(231, 184, 101, 0.38);
            border-bottom-color: var(--fiox-amber-light);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.86rem;
            color: var(--fiox-charcoal);
            margin-bottom: 8px;
        }

        .form-control,
        .form-select,
        textarea.form-control {
            border: 1px solid var(--fiox-border);
            border-radius: 8px;
            padding: 11px 14px;
            font-size: 0.9rem;
            color: var(--fiox-charcoal-soft);
            background: var(--fiox-bg);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--fiox-amber);
            box-shadow: 0 0 0 0.2rem rgba(184, 121, 31, 0.12);
            background: #fff;
        }

        /* ---- Captcha ---- */
        .captcha-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .captcha-img {
            height: 50px;
            border: 1px solid var(--fiox-border);
            border-radius: 8px;
            background: var(--fiox-bg);
            display: block;
        }

        .captcha-refresh {
            width: 42px;
            height: 42px;
            border: 1px solid var(--fiox-border);
            border-radius: 8px;
            background: var(--fiox-bg);
            color: var(--fiox-amber-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .captcha-refresh:hover {
            background: var(--fiox-amber);
            border-color: var(--fiox-amber);
            color: #fff;
        }

        .captcha-input {
            max-width: 200px;
            letter-spacing: 2px;
            font-weight: 600;
        }

        .field-error {
            color: #c0392b;
            font-size: 0.82rem;
            margin-top: 6px;
            font-weight: 500;
        }

        .btn-fiox-solid {
            background: linear-gradient(90deg, var(--fiox-amber), var(--fiox-amber-dark));
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 13px 34px;
            font-size: 0.95rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s ease;
        }

        .btn-fiox-solid:hover {
            color: #fff;
            box-shadow: 0 8px 22px rgba(184, 121, 31, 0.3);
            transform: translateY(-2px);
        }

        @media (max-width: 767px) {
            .page-banner { padding: 60px 0; }
            .page-banner h1 { font-size: 1.9rem; }
            .contact-section { padding: 60px 0 70px; }
            .contact-form-card { padding: 30px 24px; }
        }
    </style>
</head>
<body>
    <!-- ================= PAGE BANNER ================= -->
    <section class="page-banner">
        <div class="section-wrap">
            <h1>Let's Talk About Your Project</h1>
            <p>
                Send us your requirements — diameter, quantity and application — and we’ll get back to you with specifications, pricing and sample availability.
            </p>
        </div>
    </section>

    <!-- ================= CONTACT SECTION ================= -->
    <section class="contact-section">
        <div class="section-wrap">
            <div class="row g-5">

                <!-- LEFT: CONTACT DETAILS -->
                <div class="col-lg-5">
                    <div class="section-tag">Get In Touch</div>
                    <h2 class="section-title mb-4">Contact Details</h2>

                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-person-fill"></i></div>
                        <div>
                            <div class="info-label">Contact Person</div>
                            <p class="info-value">Shaiban Girach</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="info-label">Phone</div>
                            <p class="info-value"><a href="tel:+919228270185">+91 92282 70185</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <div class="info-label">Email</div>
                            <p class="info-value"><a href="mailto:info@fioxcomposites.com">info@fioxcomposites.com</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <div class="info-label">EXPORT ENQUIRIES</div>
                            <p class="info-value"><a href="mailto:export@fioxcomposites.com">export@fioxcomposites.com</a></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <div class="info-label">Address</div>
                            <p class="info-value">
                                105, Vinayak Complex, Sadhu Vasvani Rd,<br>
                                Nr. Gangotri Dairy, Rajkot, Gujarat &ndash; 360 005
                            </p>
                        </div>
                    </div>

                    <div class="map-frame mt-3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3691.611787321245!2d70.7570374793457!3d22.292690900000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959cbc7e164893b%3A0xddf6423d7a5e75c6!2sFiox%20Global%20Composites!5e0!3m2!1sen!2sin!4v1789305819166!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    </div>
                </div>

                <!-- RIGHT: CONTACT FORM -->
                <div class="col-lg-7">
                    <div class="contact-form-card">
                        <div class="section-tag">Get In Touch</div>
                        <h2 class="section-title mb-2">Tell Us About Your Requirement</h2>
                        <p class="text-muted mb-4" style="font-size: 0.92rem;">
                            Fill in the details below and our team will get back to you with specifications,
                            pricing and sample availability.
                        </p>

                        @php
                            // Same source/query as the header's Products dropdown, so this
                            // list always matches what's shown in the site nav.
                            $contactProducts = \App\Models\Product::where('status', 'active')
                                ->orderBy('name')
                                ->get();
                        @endphp

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name <span style="color:#c0392b;">*</span></label>
                                    <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" placeholder="Your full name">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control" placeholder="Your company name">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Phone Number <span style="color:#c0392b;">*</span></label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="+91 00000 00000">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email Address </label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="you@company.com">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Product Interested In</label>
                                    <div class="form-group">
                                        <select name="product_interest" class="form-select">
                                            <option value="">Select a product</option>
                                            @forelse ($contactProducts as $cp)
                                                <option value="{{ $cp->id }}" {{ old('product_interest') == $cp->id ? 'selected' : '' }}>{{ $cp->name }}</option>
                                            @empty
                                                <option value="" disabled>No products available</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Requirement Details</label>
                                    <textarea name="description" rows="5" class="form-control"
                                        placeholder="Tell us about diameter, quantity, application and expected timeline...">{{ old('description') }}</textarea>
                                </div>

                                <!-- ================= CAPTCHA ================= -->
                                <div class="col-12">
                                    <label class="form-label">Security Code <span style="color:#c0392b;">*</span></label>
                                    <div class="captcha-row">
                                        <img src="{{ route('contact.captcha') }}?t={{ time() }}" id="captchaImg" class="captcha-img" alt="Captcha code">
                                        <button type="button" class="captcha-refresh" id="captchaRefresh" title="Refresh code" aria-label="Refresh captcha">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                        <input type="text" name="captcha" class="form-control captcha-input"
                                            placeholder="Enter code" maxlength="5" autocomplete="off"
                                            autocapitalize="off" autocorrect="off" spellcheck="false" required>
                                    </div>
                                    @error('captcha')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn-fiox-solid">
                                        <i class="bi bi-send-fill"></i> Send Inquiry
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('captchaRefresh').addEventListener('click', function () {
            document.getElementById('captchaImg').src = "{{ route('contact.captcha') }}?t=" + Date.now();
            document.querySelector('input[name="captcha"]').value = '';
        });
    </script>
</body>
</html>
@endsection