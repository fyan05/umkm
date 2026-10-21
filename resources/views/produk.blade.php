@extends('template')

@section('title', 'Kontak - BimShop')

@php
    // ====== ISI DATA ASLI KAMU DI SINI ======
    $wa      = '6281234567890';                 // format internasional tanpa + atau 0 di depan
    $waTampil = '0812-3456-7890';
    $email   = 'halo@bimshop.id';
    $alamat  = 'Mangunreja, Jawa Barat';        // lengkapi alamat sebenarnya
    $jam     = 'Setiap hari, 08.00 - 17.00 WIB';
@endphp

@push('styles')
<style>
    /* ================= KEYFRAMES ================= */
    @keyframes naik {
        from { opacity: 0; transform: translateY(26px); }
        to   { opacity: 1; transform: none; }
    }
    @keyframes melayang {
        0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
        50%      { transform: translate3d(0, -22px, 0) scale(1.05); }
    }
    @keyframes denyut {
        0%   { box-shadow: 0 0 0 0 rgba(227,168,43,.55); }
        70%  { box-shadow: 0 0 0 14px rgba(227,168,43,0); }
        100% { box-shadow: 0 0 0 0 rgba(227,168,43,0); }
    }
    @keyframes goyang {
        0%, 100% { transform: rotate(0); }
        25%      { transform: rotate(-14deg); }
        75%      { transform: rotate(14deg); }
    }
    @keyframes getar {
        10%, 90% { transform: translateX(-2px); }
        20%, 80% { transform: translateX(4px); }
        30%, 50%, 70% { transform: translateX(-6px); }
        40%, 60% { transform: translateX(6px); }
    }

    /* ================= HERO ================= */
    .kontak-hero {
        background: var(--bim-green); color: #fff; padding: 4.5rem 0 5.5rem;
        position: relative; overflow: hidden;
    }
    .kontak-hero .container { position: relative; z-index: 1; }
    /* lingkaran dekoratif yang melayang pelan */
    .kontak-hero::before,
    .kontak-hero::after {
        content: ""; position: absolute; border-radius: 50%;
        background: var(--bim-gold); opacity: .16; pointer-events: none;
        animation: melayang 7s ease-in-out infinite;
    }
    .kontak-hero::before { width: 260px; height: 260px; right: -60px; top: -70px; }
    .kontak-hero::after  { width: 150px; height: 150px; right: 18%; bottom: -60px; animation-duration: 9s; animation-delay: -3s; }

    .kontak-hero h1 {
        font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800;
        letter-spacing: -0.02em; line-height: 1.05;
        font-size: clamp(2.1rem, 5vw, 3.5rem); max-width: 16ch;
        animation: naik .8s cubic-bezier(.2,.7,.2,1) both;
    }
    .kontak-hero p {
        max-width: 44ch; color: rgba(255,255,255,.85); font-size: 1.1rem;
        animation: naik .8s .15s cubic-bezier(.2,.7,.2,1) both;
    }

    .kontak-wrap { margin-top: -3rem; padding-bottom: 5rem; position: relative; z-index: 1; }

    /* ================= SCROLL REVEAL ================= */
    /* hanya aktif kalau JS berjalan (class reveal-ready), jadi konten tidak pernah hilang */
    .reveal-ready .reveal {
        opacity: 0; transform: translateY(28px);
        transition: opacity .7s ease, transform .7s cubic-bezier(.2,.7,.2,1);
        transition-delay: var(--d, 0s);
    }
    .reveal-ready .reveal.dari-kiri  { transform: translateX(-32px); }
    .reveal-ready .reveal.dari-kanan { transform: translateX(32px); }
    .reveal-ready .reveal.tampil     { opacity: 1; transform: none; }

    /* ================= INFO KONTAK ================= */
    .kontak-info {
        background: #fff; border: 1px solid var(--bim-line); border-radius: 18px;
        padding: .5rem 1.5rem; height: 100%;
    }
    .kontak-item { display: flex; gap: 1rem; padding: 1.2rem 0; border-bottom: 1px solid var(--bim-line); }
    .kontak-item:last-child { border-bottom: 0; }
    .kontak-icon {
        flex: 0 0 46px; height: 46px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background: var(--bim-green); color: var(--bim-gold); font-size: 1.05rem;
        transition: transform .3s cubic-bezier(.3,1.6,.5,1), background .3s, color .3s;
    }
    .kontak-item:hover .kontak-icon { transform: scale(1.15) rotate(-8deg); background: var(--bim-gold); color: var(--bim-green-dark); }
    .kontak-item h6 { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; margin: 0 0 .15rem; }
    .kontak-item p, .kontak-item a { margin: 0; color: #5f6b64; text-decoration: none; word-break: break-word; transition: color .2s; }
    .kontak-item a:hover { color: var(--bim-green); text-decoration: underline; }

    /* ================= FORM ================= */
    .kontak-form {
        background: #fff; border: 1px solid var(--bim-line); border-radius: 18px; padding: 2rem;
        box-shadow: 0 14px 36px rgba(31,77,58,.08);
        transition: box-shadow .35s ease, transform .35s ease;
    }
    .kontak-form:hover { box-shadow: 0 20px 44px rgba(31,77,58,.14); transform: translateY(-3px); }
    .kontak-form h2 { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; font-size: 1.6rem; letter-spacing: -0.02em; }
    .kontak-form .form-control, .kontak-form .form-select {
        border-radius: 10px; padding: .7rem .9rem; border-color: var(--bim-line);
        transition: border-color .2s, box-shadow .2s, transform .2s;
    }
    .kontak-form .form-control:focus, .kontak-form .form-select:focus {
        border-color: var(--bim-green); box-shadow: 0 0 0 3px rgba(227,168,43,.35);
        transform: translateY(-2px);
    }
    .kontak-form .getar { animation: getar .5s both; border-color: #dc3545; }

    .btn-kirim {
        background: var(--bim-gold); color: var(--bim-green-dark);
        font-weight: 600; border: 0; border-radius: 999px; padding: .85rem 1.8rem;
        transition: background .2s, transform .2s;
        animation: denyut 2.4s infinite;
    }
    .btn-kirim:hover { background: var(--bim-gold-dark); color: var(--bim-green-dark); transform: translateY(-2px); animation-play-state: paused; }
    .btn-kirim:active { transform: translateY(0) scale(.97); }
    .btn-kirim:hover .fa-whatsapp { display: inline-block; animation: goyang .5s; }

    .btn-wa-langsung {
        border: 1.5px solid var(--bim-green); color: var(--bim-green);
        border-radius: 999px; font-weight: 600; padding: .6rem 1.4rem;
        transition: background .25s, color .25s, transform .2s;
    }
    .btn-wa-langsung:hover { background: var(--bim-green); color: #fff; transform: translateY(-2px); }

    @media (max-width: 767.98px) {
        .kontak-hero { padding: 3rem 0 4.5rem; }
        .kontak-form { padding: 1.4rem; }
        .kontak-wrap { padding-bottom: 3rem; }
        .kontak-hero::before { width: 170px; height: 170px; }
    }

    /* hormati pengguna yang mematikan animasi di perangkatnya */
    @media (prefers-reduced-motion: reduce) {
        .kontak-hero::before, .kontak-hero::after,
        .kontak-hero h1, .kontak-hero p, .btn-kirim, .kontak-form .getar { animation: none !important; }
        .reveal-ready .reveal { opacity: 1 !important; transform: none !important; transition: none !important; }
        .kontak-form, .kontak-icon, .btn-kirim, .btn-wa-langsung { transition: none !important; }
    }
</style>
@endpush

@section('content')

<section class="kontak-hero">
    <div class="container">
        <h1>Ada yang ingin ditanyakan?</h1>
        <p class="mt-3 mb-0">Tanya produk, cara pesan, atau pengiriman. Kami balas lewat WhatsApp.</p>
    </div>
</section>

<section class="kontak-wrap">
    <div class="container">
        <div class="row g-4">

            {{-- INFO KONTAK --}}
            <div class="col-lg-5">
                <div class="kontak-info">
                    <div class="kontak-item reveal dari-kiri" style="--d:.05s">
                        <div class="kontak-icon"><i class="fab fa-whatsapp"></i></div>
                        <div>
                            <h6>WhatsApp</h6>
                            <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener">{{ $waTampil }}</a>
                        </div>
                    </div>
                    <div class="kontak-item reveal dari-kiri" style="--d:.15s">
                        <div class="kontak-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h6>Email</h6>
                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                        </div>
                    </div>
                    <div class="kontak-item reveal dari-kiri" style="--d:.25s">
                        <div class="kontak-icon"><i class="fas fa-location-dot"></i></div>
                        <div>
                            <h6>Alamat</h6>
                            <p>{{ $alamat }}</p>
                        </div>
                    </div>
                    <div class="kontak-item reveal dari-kiri" style="--d:.35s">
                        <div class="kontak-icon"><i class="fas fa-clock"></i></div>
                        <div>
                            <h6>Jam layanan</h6>
                            <p>{{ $jam }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORM --}}
            <div class="col-lg-7">
                <div class="kontak-form reveal dari-kanan" style="--d:.2s">
                    <h2 class="mb-1">Kirim pesan</h2>
                    <p class="text-muted mb-4">Pesan Anda akan terbuka di WhatsApp, tinggal tekan kirim.</p>

                    <form id="formKontak" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nama" class="form-label fw-semibold">Nama</label>
                                <input type="text" class="form-control" id="nama" required>
                                <div class="invalid-feedback">Isi nama Anda.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="topik" class="form-label fw-semibold">Keperluan</label>
                                <select class="form-select" id="topik" required>
                                    <option value="" selected disabled>Pilih keperluan</option>
                                    <option>Tanya produk</option>
                                    <option>Pesan produk</option>
                                    <option>Pengiriman</option>
                                    <option>Lainnya</option>
                                </select>
                                <div class="invalid-feedback">Pilih salah satu keperluan.</div>
                            </div>
                            <div class="col-12">
                                <label for="pesan" class="form-label fw-semibold">Pesan</label>
                                <textarea class="form-control" id="pesan" rows="5" required></textarea>
                                <div class="invalid-feedback">Tulis pesan Anda.</div>
                            </div>
                            <div class="col-12 d-flex flex-wrap gap-2 align-items-center">
                                <button type="submit" class="btn btn-kirim">
                                    <i class="fab fa-whatsapp me-1"></i> Kirim lewat WhatsApp
                                </button>
                                <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="btn btn-wa-langsung">Chat langsung</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    (function () {
        var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // ---------- Scroll reveal ----------
        var items = document.querySelectorAll('.reveal');
        if (!reduce && 'IntersectionObserver' in window) {
            document.documentElement.classList.add('reveal-ready');
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (en) {
                    if (en.isIntersecting) {
                        en.target.classList.add('tampil');
                        io.unobserve(en.target);
                    }
                });
            }, { threshold: 0.15 });
            items.forEach(function (el) { io.observe(el); });
        }

        // ---------- Form ----------
        var form = document.getElementById('formKontak');
        var nomor = '{{ $wa }}';

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                // getarkan kolom yang belum valid
                form.querySelectorAll(':invalid').forEach(function (el) {
                    el.classList.remove('getar');
                    void el.offsetWidth; // restart animasi
                    el.classList.add('getar');
                    el.addEventListener('animationend', function () { el.classList.remove('getar'); }, { once: true });
                });
                return;
            }
            var teks =
                'Halo BimShop, saya ' + document.getElementById('nama').value.trim() + '.\n' +
                'Keperluan: ' + document.getElementById('topik').value + '\n\n' +
                document.getElementById('pesan').value.trim();

            window.open('https://wa.me/' + nomor + '?text=' + encodeURIComponent(teks), '_blank', 'noopener');
        });
    })();
</script>
@endpush
