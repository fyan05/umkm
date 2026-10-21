@extends('template')

@section('title', 'Tentang Kami - BimShop')

@push('styles')
<style>
    /* ================= KEYFRAMES ================= */
    @keyframes naik {
        from { opacity: 0; transform: translateY(26px); }
        to   { opacity: 1; transform: none; }
    }
    @keyframes zoomPelan {
        from { transform: scale(1); }
        to   { transform: scale(1.12); }
    }
    @keyframes melayang {
        0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
        50%      { transform: translate3d(0, -20px, 0) scale(1.05); }
    }
    @keyframes denyut {
        0%   { box-shadow: 0 0 0 0 rgba(227,168,43,.55); }
        70%  { box-shadow: 0 0 0 14px rgba(227,168,43,0); }
        100% { box-shadow: 0 0 0 0 rgba(227,168,43,0); }
    }

    /* ================= SCROLL REVEAL ================= */
    /* hanya aktif kalau JS berjalan (class reveal-ready), jadi konten tidak pernah hilang */
    .reveal-ready .reveal {
        opacity: 0; transform: translateY(30px);
        transition: opacity .7s ease, transform .7s cubic-bezier(.2,.7,.2,1);
        transition-delay: var(--d, 0s);
    }
    .reveal-ready .reveal.dari-kiri  { transform: translateX(-34px); }
    .reveal-ready .reveal.dari-kanan { transform: translateX(34px); }
    .reveal-ready .reveal.zoom       { transform: scale(.94); }
    .reveal-ready .reveal.tampil     { opacity: 1; transform: none; }

    /* ================= HERO ================= */
    .about-hero {
        position: relative; overflow: hidden;
        min-height: 52vh;
        display: flex; align-items: center;
        color: #fff;
        background: var(--bim-green-dark, #143528);
    }
    /* foto latar yang zoom pelan (Ken Burns) */
    .about-hero-bg {
        position: absolute; inset: 0; z-index: 0;
        background: url('{{ asset('assets/logo/Rengginang.jpg') }}') center / cover no-repeat;
        animation: zoomPelan 20s ease-in-out infinite alternate;
    }
    .about-hero::before {
        content: ""; position: absolute; inset: 0; z-index: 1;
        background: linear-gradient(90deg, rgba(20,53,40,.93) 0%, rgba(20,53,40,.75) 55%, rgba(20,53,40,.3) 100%);
    }
    .about-hero .container { position: relative; z-index: 2; }
    .about-hero h1 {
        font-family: 'Bricolage Grotesque', sans-serif;
        font-weight: 800; letter-spacing: -0.02em; line-height: 1.05;
        font-size: clamp(2.2rem, 5.5vw, 4rem); max-width: 16ch;
        animation: naik .9s cubic-bezier(.2,.7,.2,1) both;
    }
    .about-hero p {
        max-width: 42ch; font-size: 1.15rem; color: rgba(255,255,255,.88);
        animation: naik .9s .18s cubic-bezier(.2,.7,.2,1) both;
    }

    .about-section { padding: 5rem 0; }
    .about-title {
        font-family: 'Bricolage Grotesque', sans-serif;
        font-weight: 700; letter-spacing: -0.02em;
        font-size: clamp(1.7rem, 3.2vw, 2.4rem);
    }
    .about-text { color: #5f6b64; font-size: 1.05rem; line-height: 1.8; max-width: 60ch; }

    /* foto cerita: bingkai dipakai untuk reveal + efek zoom saat hover */
    .about-photo-wrap { overflow: hidden; border-radius: 28px 4px 28px 4px; }
    .about-photo {
        display: block; width: 100%; aspect-ratio: 4 / 3; object-fit: cover;
        transition: transform .8s cubic-bezier(.2,.7,.2,1);
    }
    .about-photo-wrap:hover .about-photo { transform: scale(1.07); }

    /* Prinsip */
    .about-soft { background: #f3f6f1; }
    .about-value { display: flex; gap: 1rem; align-items: flex-start; }
    .about-value-icon {
        flex: 0 0 52px; height: 52px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background: var(--bim-green); color: var(--bim-gold); font-size: 1.2rem;
        transition: transform .35s cubic-bezier(.3,1.6,.5,1), background .3s, color .3s;
    }
    .about-value:hover .about-value-icon { transform: scale(1.15) rotate(-8deg); background: var(--bim-gold); color: var(--bim-green-dark); }
    .about-value h5 { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; margin-bottom: .25rem; }
    .about-value p { color: #5f6b64; margin: 0; }

    /* Alur (urutan nyata) */
    .about-steps { counter-reset: step; list-style: none; padding: 0; margin: 0; }
    .about-steps li {
        counter-increment: step;
        position: relative; padding: 0 0 2rem 4rem;
    }
    .about-steps li:last-child { padding-bottom: 0; }
    .about-steps li::before {
        content: counter(step);
        position: absolute; left: 0; top: 0;
        width: 2.6rem; height: 2.6rem; border-radius: 50%;
        background: var(--bim-gold); color: var(--bim-green-dark);
        font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800;
        display: flex; align-items: center; justify-content: center;
    }
    .about-steps li::after {
        content: ""; position: absolute; left: 1.3rem; top: 2.8rem; bottom: .2rem;
        width: 2px; background: var(--bim-line);
    }
    .about-steps li:last-child::after { display: none; }
    .about-steps h5 { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; margin-bottom: .2rem; }
    .about-steps p { color: #5f6b64; margin: 0; }

    /* nomor langkah "pop" dan garis penghubung tumbuh ke bawah */
    .reveal-ready .about-steps li::before { transform: scale(0); transition: transform .5s cubic-bezier(.3,1.6,.5,1); transition-delay: calc(var(--d, 0s) + .15s); }
    .reveal-ready .about-steps li::after  { transform: scaleY(0); transform-origin: top; transition: transform .7s ease; transition-delay: calc(var(--d, 0s) + .35s); }
    .reveal-ready .about-steps li.tampil::before,
    .reveal-ready .about-steps li.tampil::after { transform: none; }

    /* Kategori */
    .cat-card {
        position: relative; display: block; overflow: hidden;
        border-radius: 18px; min-height: 280px; color: #fff; text-decoration: none;
        background-size: cover; background-position: center;
        transition: transform .35s cubic-bezier(.2,.7,.2,1), box-shadow .35s ease;
    }
    .cat-card::before {
        content: ""; position: absolute; inset: 0;
        background: linear-gradient(180deg, rgba(20,53,40,.05) 30%, rgba(20,53,40,.88) 100%);
        transition: background .25s ease;
    }
    .cat-card:hover { transform: translateY(-6px); box-shadow: 0 22px 44px rgba(20,53,40,.28); }
    .cat-card:hover::before { background: linear-gradient(180deg, rgba(20,53,40,.2) 10%, rgba(20,53,40,.92) 100%); }
    .cat-card:focus-visible { outline: 3px solid var(--bim-gold); outline-offset: 3px; }
    .cat-card-body { position: absolute; left: 0; right: 0; bottom: 0; padding: 1.5rem; transition: transform .35s cubic-bezier(.2,.7,.2,1); }
    .cat-card:hover .cat-card-body { transform: translateY(-6px); }
    .cat-card h3 { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; margin: 0 0 .25rem; }
    .cat-card span { font-weight: 500; color: var(--bim-gold); }
    .cat-card span .fa-arrow-right { display: inline-block; transition: transform .3s ease; }
    .cat-card:hover span .fa-arrow-right { transform: translateX(8px); }

    /* CTA */
    .about-cta {
        position: relative; overflow: hidden;
        background: var(--bim-green); color: #fff; border-radius: 24px; padding: 3.5rem 2rem;
    }
    .about-cta > * { position: relative; z-index: 1; }
    .about-cta::before,
    .about-cta::after {
        content: ""; position: absolute; border-radius: 50%;
        background: var(--bim-gold); opacity: .14; pointer-events: none;
        animation: melayang 8s ease-in-out infinite;
    }
    .about-cta::before { width: 220px; height: 220px; left: -60px; top: -80px; }
    .about-cta::after  { width: 140px; height: 140px; right: 8%; bottom: -55px; animation-duration: 10s; animation-delay: -4s; }
    .about-cta p { color: rgba(255,255,255,.8); }
    .btn-about {
        background: var(--bim-gold); color: var(--bim-green-dark);
        font-weight: 600; border: 0; border-radius: 999px; padding: .85rem 1.8rem;
        transition: background .2s, transform .2s;
        animation: denyut 2.4s infinite;
    }
    .btn-about:hover { background: var(--bim-gold-dark); color: var(--bim-green-dark); transform: translateY(-2px); animation-play-state: paused; }
    .btn-about:active { transform: translateY(0) scale(.97); }

    @media (max-width: 767.98px) {
        .about-section { padding: 3.5rem 0; }
        .about-hero::before { background: linear-gradient(180deg, rgba(20,53,40,.88), rgba(20,53,40,.65)); }
    }

    /* hormati pengguna yang mematikan animasi di perangkatnya */
    @media (prefers-reduced-motion: reduce) {
        .about-hero-bg, .about-hero h1, .about-hero p,
        .about-cta::before, .about-cta::after, .btn-about { animation: none !important; }
        .reveal-ready .reveal,
        .reveal-ready .about-steps li::before,
        .reveal-ready .about-steps li::after { opacity: 1 !important; transform: none !important; transition: none !important; }
        .about-photo, .about-value-icon, .cat-card, .cat-card-body, .btn-about { transition: none !important; }
    }
</style>
@endpush

@section('content')

{{-- HEADER --}}
<section class="about-hero">
    <div class="about-hero-bg" aria-hidden="true"></div>
    <div class="container">
        <h1>Dari dapur UMKM Mangunreja ke meja Anda.</h1>
        <p class="mt-3 mb-0">Kami menjual cemilan khas daerah yang dibuat dengan resep dan cara tradisional.</p>
    </div>
</section>

{{-- CERITA --}}
<section class="about-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2">
                <div class="about-photo-wrap reveal dari-kanan">
                    <img src="{{ asset('assets/logo/rg.jpg') }}" alt="Rengginang buatan UMKM Mangunreja" class="about-photo" loading="lazy">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <h2 class="about-title mb-3 reveal dari-kiri">Cerita BimShop</h2>
                <p class="about-text mb-3 reveal dari-kiri" style="--d:.1s">
                    BimShop adalah toko online yang menyediakan berbagai cemilan khas daerah Mangunreja dan sekitarnya,
                    mulai dari rengginang, keripik, sampai makanan ringan tradisional lainnya.
                </p>
                <p class="about-text mb-0 reveal dari-kiri" style="--d:.2s">
                    Kami hadir supaya produk UMKM lokal bisa sampai ke lebih banyak orang, tanpa mengubah rasa asli
                    yang sudah dikenal turun-temurun.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- PRINSIP --}}
<section class="about-section about-soft">
    <div class="container">
        <h2 class="about-title mb-5 reveal">Yang kami pegang</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="about-value reveal" style="--d:.05s">
                    <div class="about-value-icon"><i class="fas fa-hand-holding-heart"></i></div>
                    <div>
                        <h5>Produk lokal asli</h5>
                        <p>Setiap produk dibuat oleh pelaku UMKM di Mangunreja dan sekitarnya.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-value reveal" style="--d:.2s">
                    <div class="about-value-icon"><i class="fas fa-star"></i></div>
                    <div>
                        <h5>Kualitas terjamin</h5>
                        <p>Kami seleksi ketat supaya rasa dan kerenyahannya tetap terjaga.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-value reveal" style="--d:.35s">
                    <div class="about-value-icon"><i class="fas fa-shipping-fast"></i></div>
                    <div>
                        <h5>Pengiriman cepat</h5>
                        <p>Pesanan dikirim langsung dari produsen ke rumah Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ALUR --}}
<section class="about-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <h2 class="about-title mb-3 reveal dari-kiri">Bagaimana pesanan Anda sampai</h2>
                <p class="about-text mb-0 reveal dari-kiri" style="--d:.1s">Tiga langkah singkat dari dapur produsen sampai di depan pintu.</p>
            </div>
            <div class="col-lg-7">
                <ol class="about-steps">
                    <li class="reveal" style="--d:.05s">
                        <h5>Dibuat oleh produsen lokal</h5>
                        <p>Cemilan dibuat dengan bahan pilihan dan resep khas daerah.</p>
                    </li>
                    <li class="reveal" style="--d:.25s">
                        <h5>Diseleksi dan dikemas</h5>
                        <p>Setiap produk dicek kualitasnya sebelum dikemas rapat agar tetap renyah.</p>
                    </li>
                    <li class="reveal" style="--d:.45s">
                        <h5>Dikirim ke rumah Anda</h5>
                        <p>Pesanan dikirim langsung dari produsen tanpa perantara panjang.</p>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

{{-- KATEGORI --}}
<section class="about-section about-soft">
    <div class="container">
        <h2 class="about-title mb-2 reveal">Pilih berdasarkan rasa</h2>
        <p class="text-muted mb-5 reveal" style="--d:.1s">Mau yang gurih atau yang manis? Lihat produknya di sini.</p>

        <div class="row g-4">
            <div class="col-md-6">
                <a href="{{ url('/produk/asin') }}" class="cat-card reveal zoom" style="background-image: url('{{ asset('assets/logo/rg.jpg') }}'); --d:.05s">
                    <div class="cat-card-body">
                        <h3>Asin</h3>
                        <span>Lihat produk <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ url('/produk/manis') }}" class="cat-card reveal zoom" style="background-image: url('{{ asset('assets/logo/manis.jpg') }}'); --d:.2s">
                    <div class="cat-card-body">
                        <h3>Manis</h3>
                        <span>Lihat produk <i class="fas fa-arrow-right ms-1"></i></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="about-section pb-5">
    <div class="container">
        <div class="about-cta text-center reveal zoom">
            <h2 class="about-title mb-2">Dukung UMKM, nikmati rasa daerah.</h2>
            <p class="mb-4">Setiap pembelian membantu produsen lokal tetap berkarya.</p>
            <a href="{{ url('/') }}#produk" class="btn btn-about btn-lg">Belanja sekarang</a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    (function () {
        var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduce || !('IntersectionObserver' in window)) return;

        document.documentElement.classList.add('reveal-ready');

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) {
                    en.target.classList.add('tampil');
                    io.unobserve(en.target);
                }
            });
        }, { threshold: 0.15 });

        document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
    })();
</script>
@endpush
