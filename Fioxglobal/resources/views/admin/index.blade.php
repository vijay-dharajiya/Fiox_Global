<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard | FIOX Global Composites</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --fiox-amber: #B8791F;
            --fiox-amber-dark: #8F5F16;
            --fiox-amber-light: #E7B865;
            --fiox-charcoal: #2F2F30;
            --fiox-charcoal-soft: #3D3D3D;
            --fiox-bg: #FAF8F5;
            --fiox-border: #EDE6DA;
            --fiox-text-muted: #8A8580;

            --sidebar-width: 260px;
            --topbar-height: 96px;
        }

        * { font-family: 'Poppins', 'Segoe UI', sans-serif; }

        body {
            background: var(--fiox-bg);
            margin: 0;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--fiox-charcoal) 0%, #232324 100%);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1040;
            overflow-y: auto;
            border-right: 3px solid var(--fiox-amber);
        }

        .admin-sidebar .brand {
            height: var(--topbar-height);
            background: #fff;
            padding: 8px 16px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-sidebar .brand img {
            height: auto;
            max-height: 100%;
            width: auto;
            max-width: 100%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .admin-sidebar nav {
            padding: 20px 0 24px;
        }

        .admin-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.65);
            padding: 12px 18px;
            font-size: 0.92rem;
            font-weight: 500;
            border-radius: 8px;
            margin: 3px 14px;
            line-height: 1.3;
            transition: all 0.2s ease;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            color: #fff;
            background: linear-gradient(90deg, var(--fiox-amber), var(--fiox-amber-dark));
        }

        .admin-sidebar .nav-link i.bi {
            width: 20px;
            font-size: 1.05rem;
            text-align: center;
        }

        .admin-sidebar .sidebar-heading {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 22px 24px 8px;
        }

        .submenu {
            padding-left: 4px;
        }

        .submenu .nav-link {
            padding: 10px 18px 10px 42px;
            font-size: 0.86rem;
            margin: 2px 14px;
        }

        .admin-sidebar .nav-link .badge {
            font-size: 0.68rem;
            padding: 4px 8px;
        }

        /* ===== TOPBAR ===== */
        .admin-topbar {
            height: var(--topbar-height);
            background: #fff;
            border-bottom: 1px solid var(--fiox-border);
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(184, 121, 31, 0.05);
            padding: 0 28px;
        }

        .admin-topbar h6 {
            font-size: 0.98rem;
            letter-spacing: 0.2px;
        }

        .logout-btn {
            background: rgba(184, 121, 31, 0.08);
            color: var(--fiox-amber-dark);
            border: 1px solid rgba(184, 121, 31, 0.3);
            border-radius: 8px;
            padding: 9px 20px;
            font-size: 0.88rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: var(--fiox-amber);
            color: #fff;
            border-color: var(--fiox-amber);
        }

        /* ===== MAIN CONTENT ===== */
        .admin-main {
            margin-left: var(--sidebar-width);
            padding-top: calc(var(--topbar-height) + 28px);
            padding-bottom: 40px;
            min-height: 100vh;
        }

        .admin-main .container-fluid {
            padding-left: 28px;
            padding-right: 28px;
        }

        @media (max-width: 991px) {
            .admin-sidebar { left: calc(-1 * var(--sidebar-width)); transition: left 0.3s ease; }
            .admin-sidebar.show { left: 0; }
            .admin-topbar { left: 0; padding: 0 18px; }
            .admin-main { margin-left: 0; }
            .admin-main .container-fluid { padding-left: 18px; padding-right: 18px; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="brand">
            <img src="{{ asset('logo/123.jpeg') }}" alt="FIOX Global Composites">
        </div>

        <nav class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center gap-2 active">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>

            <div class="sidebar-heading">Catalog</div>
            <a href="#productMenu" class="nav-link d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                <span class="d-flex align-items-center gap-2"><i class="bi bi-box-seam-fill"></i> Product</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse submenu" id="productMenu">
                <a href="{{ route('add_product') }}" class="nav-link d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle"></i> Add product
                </a>
                <a href="{{ route('view_product') }}" class="nav-link d-flex align-items-center gap-2">
                    <i class="bi bi-list-ul"></i> View product
                </a>
            </div>

            <a href="#applicationMenu" class="nav-link d-flex align-items-center justify-content-between" data-bs-toggle="collapse">
                <span class="d-flex align-items-center gap-2"><i class="bi bi-diagram-3-fill"></i> Application</span>
                <i class="bi bi-chevron-down small"></i>
            </a>
            <div class="collapse submenu" id="applicationMenu">
                <a href="{{ route('add_application') }}" class="nav-link d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle"></i> Add application
                </a>
                <a href="{{ route('view_application') }}" class="nav-link d-flex align-items-center gap-2">
                    <i class="bi bi-list-ul"></i> View application
                </a>
            </div>

            <div class="sidebar-heading">Company</div>
            <a href="{{ route('add_brochure') }}" class="nav-link d-flex align-items-center gap-2">
                <i class="bi bi-file-earmark-pdf-fill"></i> Brochure
            </a>

            <div class="sidebar-heading">Customers</div>
            <a href="{{ route('inquiry.view') }}" class="nav-link d-flex align-items-center gap-2">
                <i class="bi bi-chat-left-text-fill"></i>
                <span>Product inquiry</span>
                @if(isset($newInquiryCount) && $newInquiryCount > 0)
                    <span class="badge rounded-pill ms-auto" style="background: var(--fiox-amber);">{{ $newInquiryCount }}</span>
                @endif
            </a>
        </nav>
    </aside>

    <!-- TOPBAR -->
    <header class="admin-topbar d-flex align-items-center justify-content-between">
        <button class="btn d-lg-none p-0" id="sidebarToggle">
            <i class="bi bi-list fs-4"></i>
        </button>

        <h6 class="mb-0 fw-semibold" style="color: var(--fiox-charcoal);">
            {{ Auth::user()->name }}
        </h6>

        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn logout-btn d-flex align-items-center gap-2">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </header>

    <!-- MAIN CONTENT -->
    <main class="admin-main">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.getElementById('adminSidebar').classList.toggle('show');
        });
    </script>
</body>
</html>