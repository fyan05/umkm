<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'BimShop')</title>

    <link rel="stylesheet" href="{{ asset('bootstarp/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.7.2-web/css/all.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=DM+Sans:wght@400;500;600&display=swap');

        :root {
            --bim-green: #1f4d3a;
            --bim-green-dark: #143528;
            --bim-gold: #e3a82b;
            --bim-gold-dark: #c98f14;
            --bim-ink: #1c2420;
            --bim-line: #dfe6dc;
        }

        html { scroll-behavior: smooth; scroll-padding-top: 80px; }
        body { font-family: 'DM Sans', 'Segoe UI', sans-serif; color: var(--bim-ink); }

        /* ===== Navbar ===== */
        .bim-nav {
            background: rgba(255, 255, 255, .88);
            -webkit-backdrop-filter: blur(12px);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid transparent;
            padding-block: .85rem;
            transition: padding .25s ease, border-color .25s ease, box-shadow .25s ease;
        }
        .bim-nav.is-scrolled {
            padding-block: .4rem;
            border-bottom-color: var(--bim-line);
            box-shadow: 0 6px 20px rgba(20, 53, 40, .08);
        }

        .bim-brand {
            display: flex; align-items: center; gap: .6rem;
            text-decoration: none; color: var(--bim-green);
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800; font-size: 1.35rem; letter-spacing: -0.02em;
        }
        .bim-brand img { height: 46px; width: 46px; object-fit: contain; }
        .bim-brand:hover { color: var(--bim-green-dark); }

        .bim-nav .nav-link {
            position: relative;
            color: var(--bim-ink);
            font-weight: 500;
            padding: .5rem 1rem;
        }
        .bim-nav .nav-link::after {
            content: "";
            position: absolute; left: 1rem; right: 1rem; bottom: .2rem;
            height: 2px; background: var(--bim-gold);
            transform: scaleX(0); transform-origin: left;
            transition: transform .25s ease;
        }
        .bim-nav .nav-link:hover,
        .bim-nav .nav-link.active { color: var(--bim-green); }
        .bim-nav .nav-link:hover::after,
        .bim-nav .nav-link.active::after { transform: scaleX(1); }

        .bim-nav-cta {
            background: var(--bim-green); color: #fff;
            border-radius: 999px; font-weight: 600;
            padding: .5rem 1.3rem; border: 0;
        }
        .bim-nav-cta:hover { background: var(--bim-green-dark); color: #fff; }

        .bim-toggler { border: 0; padding: .4rem .55rem; border-radius: 10px; }
        .bim-toggler:focus { box-shadow: 0 0 0 3px rgba(227, 168, 43, .45); }

        @media (max-width: 991.98px) {
            .bim-nav .navbar-collapse {
                margin-top: .75rem; padding: .75rem 0 1rem;
                border-top: 1px solid var(--bim-line);
            }
            .bim-nav .nav-link::after { left: 0; right: auto; width: 32px; }
            .bim-nav .nav-link { padding-inline: 0; }
            .bim-nav-cta { display: block; text-align: center; margin-top: .75rem; }
        }

        /* ===== Footer ===== */
        .bim-footer { background: var(--bim-green-dark); color: rgba(255, 255, 255, .78); padding: 3.5rem 0 1.5rem; }
        .bim-footer h6 { color: #fff; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 600; }
        .bim-footer a { color: rgba(255, 255, 255, .78); text-decoration: none; }
        .bim-footer a:hover { color: var(--bim-gold); }
        .bim-footer-bottom { border-top: 1px solid rgba(255, 255, 255, .14); margin-top: 2.5rem; padding-top: 1.25rem; font-size: .9rem; }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            .bim-nav, .bim-nav .nav-link::after { transition: none; }
        }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg bim-nav sticky-top" id="bimNav">
        <div class="container">
            <a class="bim-brand" href="{{ url('/') }}">
                <span>BimShop</span>
            </a>

            <button class="navbar-toggler bim-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/category') }}#about">Tentang kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/produk') }}#produk">Kontak</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="btn bim-nav-cta" href="{{ url('/') }}#produk">
                            <i class="fas fa-bag-shopping me-1"></i> Belanja
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <footer class="bim-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <h6 class="fs-5 mb-2">BimShop</h6>
                    <p class="mb-0" style="max-width: 38ch;">
                        Cemilan khas Mangunreja langsung dari UMKM lokal: rengginang, keripik, dan camilan tradisional.
                    </p>
                </div>
                <div class="col-6 col-lg-3 offset-lg-1">
                    <h6 class="mb-3">Menu</h6>
                    <ul class="list-unstyled mb-0 d-grid gap-2">
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li><a href="{{ url('/') }}#produk">Produk</a></li>
                        <li><a href="{{ url('/') }}#about">Tentang kami</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6 class="mb-3">Belanja</h6>
                    <p class="mb-0">Dukung UMKM lokal dan warisan kuliner daerah.</p>
                </div>
            </div>
            <div class="bim-footer-bottom text-center">
                &copy; {{ date('Y') }} BimShop. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="{{ asset('bootstarp/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        (function () {
            var nav = document.getElementById('bimNav');
            function onScroll() { nav.classList.toggle('is-scrolled', window.scrollY > 10); }
            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });
        })();
    </script>
    @stack('scripts')
</body>
</html>
