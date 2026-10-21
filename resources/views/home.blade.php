@extends('template')

@section('title', 'Beranda - BimShop')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=DM+Sans:wght@400;500;600&display=swap');

    :root {
        --bim-green: #1f4d3a;
        --bim-green-dark: #143528;
        --bim-gold: #e3a82b;
        --bim-gold-dark: #c98f14;
        --bim-ink: #1c2420;
        --bim-muted: #5f6b64;
        --bim-soft: #f3f6f1;
        --bim-line: #dfe6dc;
    }

    .bim-page { font-family: 'DM Sans', system-ui, sans-serif; color: var(--bim-ink); }
    .bim-page h1, .bim-page h2, .bim-page h3, .bim-page h5, .bim-page h6 {
        font-family: 'Bricolage Grotesque', 'DM Sans', sans-serif;
        letter-spacing: -0.02em;
    }

    /* Hero */
    .bim-hero {
        position: relative;
        min-height: 88vh;
        display: flex;
        align-items: center;
        color: #fff;
        background: url('{{ asset('assets/logo/Rengginang.jpg') }}') center / cover no-repeat;
    }
    .bim-hero::before {
        content: "";
        position: absolute; inset: 0;
        background: linear-gradient(90deg, rgba(20,53,40,.92) 0%, rgba(20,53,40,.72) 45%, rgba(20,53,40,.15) 100%);
    }
    .bim-hero .container { position: relative; z-index: 1; }
    .bim-hero h1 {
        font-size: clamp(2.4rem, 6vw, 4.5rem);
        font-weight: 800;
        line-height: 1.02;
        max-width: 14ch;
    }
    .bim-hero p { font-size: 1.2rem; max-width: 36ch; color: rgba(255,255,255,.88); }

    .btn-bim {
        background: var(--bim-gold); color: var(--bim-green-dark);
        font-weight: 600; border: 0; border-radius: 999px; padding: .85rem 1.8rem;
    }
    .btn-bim:hover { background: var(--bim-gold-dark); color: var(--bim-green-dark); }
    .btn-bim-ghost {
        color: #fff; border: 1.5px solid rgba(255,255,255,.55);
        border-radius: 999px; padding: .85rem 1.8rem; font-weight: 500;
    }
    .btn-bim-ghost:hover { background: rgba(255,255,255,.12); color: #fff; }

    /* Products */
    .bim-section { padding: 5.5rem 0; }
    .bim-section-title { font-size: clamp(1.8rem, 3.5vw, 2.6rem); font-weight: 700; }
    .bim-product {
        background: #fff;
        border: 1px solid var(--bim-line);
        border-radius: 14px;
        overflow: hidden;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .bim-product:hover { border-color: var(--bim-green); box-shadow: 0 10px 28px rgba(31,77,58,.12); }
    .bim-product-img { aspect-ratio: 1 / 1; width: 100%; object-fit: cover; background: var(--bim-soft); }
    .bim-product-body { padding: 1rem 1.1rem 1.2rem; }
    .bim-product-name { font-size: 1.05rem; font-weight: 700; margin-bottom: .3rem; }
    .bim-product-desc { color: var(--bim-muted); font-size: .9rem; min-height: 2.7em; margin-bottom: .75rem; }
    .bim-price { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; font-size: 1.15rem; color: var(--bim-green); }
    .btn-bim-outline {
        border: 1.5px solid var(--bim-green); color: var(--bim-green);
        border-radius: 999px; font-weight: 600; font-size: .85rem; padding: .35rem .95rem;
    }
    .btn-bim-outline:hover { background: var(--bim-green); color: #fff; }

    /* About */
    .bim-about { background: var(--bim-soft); }
    .bim-about-img {
        width: 100%; aspect-ratio: 4 / 3; object-fit: cover;
        border-radius: 28px 4px 28px 4px;
    }
    .bim-about p { color: var(--bim-muted); font-size: 1.05rem; line-height: 1.75; max-width: 60ch; }

    /* Values */
    .bim-value-icon {
        width: 64px; height: 64px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background: var(--bim-green); color: var(--bim-gold); font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    /* CTA band */
    .bim-cta { background: var(--bim-green); color: #fff; border-radius: 24px; padding: 3.5rem 2rem; }
    .bim-cta p { color: rgba(255,255,255,.8); }

    @media (max-width: 767.98px) {
        .bim-hero::before { background: linear-gradient(180deg, rgba(20,53,40,.85), rgba(20,53,40,.6)); }
        .bim-section { padding: 3.5rem 0; }
    }

    /* ===== Animasi ===== */
    .bim-page { overflow-x: clip; }

    /* Hero: muncul berurutan */
    .bim-hero-content > * { animation: bimRise .8s cubic-bezier(.2,.7,.2,1) both; }
    .bim-hero-content > :nth-child(2) { animation-delay: .15s; }
    .bim-hero-content > :nth-child(3) { animation-delay: .3s; }
    @keyframes bimRise { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: none; } }

    /* Panah scroll di hero */
    .bim-scroll {
        position: absolute; left: 50%; bottom: 1.75rem; margin-left: -22px; z-index: 1;
        width: 44px; height: 44px; border-radius: 50%;
        border: 1.5px solid rgba(255,255,255,.5); color: #fff; text-decoration: none;
        display: flex; align-items: center; justify-content: center;
        animation: bimBounce 1.8s ease-in-out 1.2s infinite;
    }
    .bim-scroll:hover { background: rgba(255,255,255,.14); color: #fff; }
    @keyframes bimBounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(8px); } }

    /* Muncul saat di-scroll (hanya aktif kalau JavaScript jalan) */
    @media (scripting: enabled) {
        .reveal {
            opacity: 0; transform: translateY(32px);
            transition: opacity .7s ease, transform .7s cubic-bezier(.2,.7,.2,1);
            transition-delay: var(--d, 0ms);
        }
        .reveal-left { transform: translateX(-36px); }
        .reveal-right { transform: translateX(36px); }
        .reveal.is-visible { opacity: 1; transform: none; }

        .reveal .bim-value-icon {
            transform: scale(.55);
            transition: transform .6s cubic-bezier(.3,1.6,.5,1) calc(var(--d, 0ms) + 150ms);
        }
        .reveal.is-visible .bim-value-icon { transform: none; }
    }

    /* Hover kartu produk */
    .bim-product { transition: border-color .2s ease, box-shadow .2s ease, transform .25s ease; }
    .bim-product:hover { transform: translateY(-5px); }
    .bim-product-img { transition: transform .5s ease; }
    .bim-product:hover .bim-product-img { transform: scale(1.06); }

    /* Hover tombol */
    .btn-bim, .btn-bim-ghost, .btn-bim-outline { transition: background .2s ease, color .2s ease, transform .2s ease, box-shadow .2s ease; }
    .btn-bim:hover { transform: translateY(-2px); box-shadow: 0 8px 18px rgba(227,168,43,.35); }
    .btn-bim-ghost:hover, .btn-bim-outline:hover { transform: translateY(-2px); }

    @media (prefers-reduced-motion: reduce) {
        .bim-hero-content > *, .bim-scroll { animation: none; }
        .reveal, .reveal .bim-value-icon, .bim-product, .bim-product-img, .btn-bim, .btn-bim-ghost, .btn-bim-outline {
            transition: none !important; transform: none !important;
        }
        .reveal { opacity: 1 !important; }
    }
</style>

<div class="bim-page">

    {{-- HERO --}}
    <section class="bim-hero">
        <div class="container">
            <div class="bim-hero-content">
                <h1>Cemilan khas Mangunreja, langsung dari pembuatnya.</h1>
                <p class="mt-3 mb-4">Rengginang, keripik, dan camilan tradisional yang dibuat UMKM lokal.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="#produk" class="btn btn-bim btn-lg">Belanja sekarang</a>
                    <a href="#about" class="btn btn-bim-ghost btn-lg">Kenali BimShop</a>
                </div>
            </div>
        </div>
        <a href="#produk" class="bim-scroll" aria-label="Lihat produk"><i class="fas fa-chevron-down"></i></a>
    </section>

    {{-- PRODUK --}}
    <section id="produk" class="bim-section">
        <div class="container">
            <div class="mb-5 reveal">
                <h2 class="bim-section-title mb-2">Produk unggulan</h2>
                <p class="text-muted mb-0">Pilih rengginang, keripik, dan camilan favorit keluarga.</p>
            </div>

            <div class="row g-3 g-lg-4">
                @forelse($produk as $item)
                    <div class="col-6 col-md-4 col-lg-3 reveal" style="--d: {{ ($loop->index % 4) * 90 }}ms">
                        <div class="bim-product h-100 d-flex flex-column">
                            <img src="{{ asset('storage/image-product/' . $item->image) }}"
                                 alt="{{ $item->name }}"
                                 class="bim-product-img"
                                 loading="lazy">
                            <div class="bim-product-body d-flex flex-column flex-grow-1">
                                <h6 class="bim-product-name">{{ $item->name }}</h6>
                                <p class="bim-product-desc">{{ Str::limit($item->deskripsi, 55) }}</p>
                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    <span class="bim-price">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                    <a href="{{ route('produk.detail', Crypt::encrypt($item->id)) }}"
                                       class="btn btn-bim-outline">Lihat detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5 text-muted border rounded-4">
                            Belum ada produk. Tambahkan produk dari halaman admin.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- TENTANG --}}
    <section id="about" class="bim-section bim-about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal reveal-left">
                    <img src="{{ asset('assets/logo/Rengginang.jpg') }}" alt="Rengginang khas Mangunreja" class="bim-about-img" loading="lazy">
                </div>
                <div class="col-lg-6 reveal reveal-right">
                    <h2 class="bim-section-title mb-3">Tentang BimShop</h2>
                    <p class="mb-3">
                        BimShop adalah toko online yang menyediakan cemilan khas daerah Mangunreja dan sekitarnya,
                        termasuk rengginang, keripik, dan makanan ringan tradisional lainnya.
                    </p>
                    <p class="mb-0">
                        Kami menjaga keaslian rasa dan kualitas produk lokal agar bisa dinikmati siapa saja, di mana saja.
                        Belanja di BimShop berarti mendukung UMKM dan warisan kuliner daerah.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- KEUNGGULAN --}}
    <section class="bim-section">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4 reveal" style="--d: 0ms">
                    <div class="bim-value-icon"><i class="fas fa-shipping-fast"></i></div>
                    <h5 class="fw-bold">Pengiriman cepat</h5>
                    <p class="text-muted mb-0">Produk dikirim langsung dari produsen ke rumah Anda.</p>
                </div>
                <div class="col-md-4 reveal" style="--d: 120ms">
                    <div class="bim-value-icon"><i class="fas fa-hand-holding-heart"></i></div>
                    <h5 class="fw-bold">Produk lokal asli</h5>
                    <p class="text-muted mb-0">Dukung UMKM lokal dengan produk asli Mangunreja.</p>
                </div>
                <div class="col-md-4 reveal" style="--d: 240ms">
                    <div class="bim-value-icon"><i class="fas fa-star"></i></div>
                    <h5 class="fw-bold">Kualitas terjamin</h5>
                    <p class="text-muted mb-0">Setiap produk kami seleksi ketat demi kualitas terbaik.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="pb-5">
        <div class="container">
            <div class="bim-cta text-center reveal">
                <h2 class="fw-bold mb-2">Siap mencoba cemilan khas Mangunreja?</h2>
                <p class="mb-4">Pilih produk favorit Anda dan kami kirim langsung dari produsen.</p>
                <a href="#produk" class="btn btn-bim btn-lg">Lihat semua produk</a>
            </div>
        </div>
    </section>

</div>
@endsection

@push('scripts')
<script>
    (function () {
        var els = document.querySelectorAll('.reveal');
        if (!('IntersectionObserver' in window)) {
            els.forEach(function (el) { el.classList.add('is-visible'); });
            return;
        }
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) {
                    en.target.classList.add('is-visible');
                    io.unobserve(en.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -6% 0px' });
        els.forEach(function (el) { io.observe(el); });
    })();
</script>
@endpush
