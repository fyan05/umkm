@extends('template')

@section('title', $produk->name . ' - BimShop')

@push('styles')
<style>
    /* ================= KEYFRAMES ================= */
    @keyframes melayang {
        0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
        50%      { transform: translate3d(0, -20px, 0) scale(1.05); }
    }
    @keyframes mengambang {
        0%, 100% { transform: translateY(0) rotate(-.6deg); }
        50%      { transform: translateY(-10px) rotate(.6deg); }
    }
    @keyframes denyut {
        0%   { box-shadow: 0 0 0 0 rgba(227,168,43,.55); }
        70%  { box-shadow: 0 0 0 14px rgba(227,168,43,0); }
        100% { box-shadow: 0 0 0 0 rgba(227,168,43,0); }
    }
    @keyframes putar { to { transform: rotate(360deg); } }
    @keyframes loncat {
        0%, 100% { transform: translateY(0); }
        40%      { transform: translateY(-4px) rotate(-8deg); }
    }

    /* ================= SCROLL / LOAD REVEAL ================= */
    /* hanya aktif kalau JS berjalan (class reveal-ready), jadi konten tidak pernah hilang */
    .reveal-ready .reveal {
        opacity: 0; transform: translateY(28px);
        transition: opacity .7s ease, transform .7s cubic-bezier(.2,.7,.2,1);
        transition-delay: var(--d, 0s);
    }
    .reveal-ready .reveal.dari-kiri  { transform: translateX(-34px); }
    .reveal-ready .reveal.dari-kanan { transform: translateX(34px); }
    .reveal-ready .reveal.tampil     { opacity: 1; transform: none; }

    /* ================= LAYOUT ================= */
    .pd-page { background: #fff; }

    .pd-crumb { font-size: .9rem; margin-bottom: 1.6rem; }
    .pd-crumb a { color: #5f6b64; text-decoration: none; transition: color .2s; }
    .pd-crumb a:hover { color: var(--bim-green); text-decoration: underline; }
    .pd-crumb .sep { color: #aab4ad; margin: 0 .4rem; }
    .pd-crumb .now { color: var(--bim-green-dark); font-weight: 600; }

    /* ---------- Foto ---------- */
    .pd-media {
        position: relative; overflow: hidden;
        background: #f3f6f1; border: 1px solid var(--bim-line);
        border-radius: 28px 4px 28px 4px;
        padding: 2.2rem; text-align: center;
    }
    .pd-media::before,
    .pd-media::after {
        content: ""; position: absolute; border-radius: 50%;
        background: var(--bim-gold); opacity: .22; pointer-events: none;
        animation: melayang 8s ease-in-out infinite;
    }
    .pd-media::before { width: 220px; height: 220px; right: -70px; top: -70px; }
    .pd-media::after  { width: 120px; height: 120px; left: -30px; bottom: -35px; animation-duration: 10s; animation-delay: -3s; }

    .pd-img-box {
        position: relative; z-index: 1; display: inline-block;
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 20px 44px rgba(31,77,58,.18);
        background: #fff;
        animation: mengambang 6s ease-in-out infinite;
    }
    .pd-img-box img {
        display: block; max-width: 100%; max-height: 420px; width: auto; height: auto;
        transition: transform .8s cubic-bezier(.2,.7,.2,1);
    }
    .pd-img-box:hover img { transform: scale(1.07); }

    /* ---------- Info ---------- */
    .pd-title {
        font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800;
        letter-spacing: -0.02em; line-height: 1.1;
        font-size: clamp(1.9rem, 4vw, 2.8rem); margin: 0 0 .9rem;
    }
    .pd-price-label { font-size: .85rem; text-transform: uppercase; letter-spacing: .08em; color: #8a958e; margin: 0; }
    .pd-price {
        font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800;
        font-size: clamp(1.7rem, 3.2vw, 2.2rem); color: var(--bim-green);
        display: inline-block; position: relative; margin: 0;
    }
    .pd-price::after {
        content: ""; position: absolute; left: 0; bottom: 2px; height: 8px; width: 100%;
        background: var(--bim-gold); opacity: .45; z-index: -1; border-radius: 4px;
        transform-origin: left; animation: garis 1s .5s cubic-bezier(.2,.7,.2,1) both;
    }
    @keyframes garis { from { transform: scaleX(0); } to { transform: scaleX(1); } }

    .pd-divider { border: 0; border-top: 1px solid var(--bim-line); margin: 1.6rem 0; opacity: 1; }

    /* ---------- Jumlah ---------- */
    .pd-qty-label { font-weight: 600; margin-bottom: .5rem; display: block; }
    .pd-qty {
        display: inline-flex; align-items: center;
        border: 1.5px solid var(--bim-line); border-radius: 999px; padding: 4px;
        background: #fff; transition: border-color .2s, box-shadow .2s;
    }
    .pd-qty:focus-within { border-color: var(--bim-green); box-shadow: 0 0 0 3px rgba(227,168,43,.35); }
    .pd-qty button {
        width: 42px; height: 42px; border-radius: 50%; border: 0;
        background: #f3f6f1; color: var(--bim-green); font-size: .9rem;
        display: inline-flex; align-items: center; justify-content: center;
        transition: background .2s, color .2s, transform .15s;
    }
    .pd-qty button:hover { background: var(--bim-green); color: var(--bim-gold); }
    .pd-qty button:active { transform: scale(.88); }
    .pd-qty input {
        width: 56px; border: 0; background: transparent; text-align: center;
        font-weight: 700; font-size: 1.1rem; outline: none; -moz-appearance: textfield;
    }
    .pd-qty input::-webkit-outer-spin-button,
    .pd-qty input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

    .pd-total { color: #5f6b64; margin: 1rem 0 0; }
    .pd-total strong {
        color: var(--bim-green-dark); font-size: 1.15rem; display: inline-block;
        transition: transform .25s cubic-bezier(.3,1.6,.5,1);
    }
    .pd-total strong.naik { transform: scale(1.15); }

    /* ---------- Tombol ---------- */
    .btn-cart {
        background: var(--bim-gold); color: var(--bim-green-dark);
        font-weight: 700; border: 0; border-radius: 999px; padding: .95rem 2rem;
        display: inline-flex; align-items: center; justify-content: center; gap: .6rem;
        transition: background .2s, transform .2s;
        animation: denyut 2.4s infinite;
    }
    .btn-cart:hover { background: var(--bim-gold-dark); color: var(--bim-green-dark); transform: translateY(-2px); animation-play-state: paused; }
    .btn-cart:hover .fa-cart-plus { display: inline-block; animation: loncat .5s; }
    .btn-cart:active { transform: translateY(0) scale(.97); }
    .btn-cart[disabled] { opacity: .85; pointer-events: none; animation: none; }
    .btn-cart .spin {
        width: 1.1rem; height: 1.1rem; border: 2.5px solid rgba(20,53,40,.25); border-top-color: var(--bim-green-dark);
        border-radius: 50%; animation: putar .7s linear infinite; display: none;
    }
    .btn-cart.memuat .spin { display: inline-block; }
    .btn-cart.memuat .fa-cart-plus { display: none; }

    /* ---------- Keunggulan ---------- */
    .pd-perks { list-style: none; padding: 0; margin: 1.8rem 0 0; display: grid; gap: .8rem; }
    .pd-perks li { display: flex; align-items: center; gap: .8rem; color: #5f6b64; }
    .pd-perk-icon {
        flex: 0 0 38px; height: 38px; border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        background: var(--bim-green); color: var(--bim-gold); font-size: .9rem;
        transition: transform .35s cubic-bezier(.3,1.6,.5,1), background .3s, color .3s;
    }
    .pd-perks li:hover .pd-perk-icon { transform: scale(1.15) rotate(-8deg); background: var(--bim-gold); color: var(--bim-green-dark); }

    /* ---------- Deskripsi ---------- */
    .pd-desc {
        margin-top: 2.5rem; background: #f3f6f1; border: 1px solid var(--bim-line);
        border-radius: 18px; padding: 1.6rem 1.8rem;
    }
    .pd-desc h5 {
        font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; margin: 0 0 .8rem;
        display: flex; align-items: center; gap: .7rem;
    }
    .pd-desc h5::before { content: ""; width: 28px; height: 4px; border-radius: 4px; background: var(--bim-gold); }
    .pd-desc p { color: #5f6b64; line-height: 1.8; margin: 0; }

    @media (max-width: 767.98px) {
        .pd-media { padding: 1.4rem; }
        .pd-img-box img { max-height: 300px; }
        .pd-desc { padding: 1.3rem; }
        .btn-cart { width: 100%; }
    }

    /* hormati pengguna yang mematikan animasi di perangkatnya */
    @media (prefers-reduced-motion: reduce) {
        .pd-media::before, .pd-media::after, .pd-img-box, .pd-price::after, .btn-cart { animation: none !important; }
        .reveal-ready .reveal { opacity: 1 !important; transform: none !important; transition: none !important; }
        .pd-img-box img, .pd-perk-icon, .pd-qty button, .pd-total strong, .btn-cart { transition: none !important; }
    }
</style>
@endpush

@section('content')
<div class="pd-page">
    <div class="container py-5 mt-5">

        {{-- BREADCRUMB --}}
        <nav class="pd-crumb reveal" aria-label="breadcrumb">
            <a href="{{ url('/') }}">Beranda</a><span class="sep">/</span>
            <a href="{{ url('/') }}#produk">Produk</a><span class="sep">/</span>
            <span class="now">{{ $produk->name }}</span>
        </nav>

        <div class="row g-4 g-lg-5 align-items-start">

            {{-- FOTO --}}
            <div class="col-md-6">
                <div class="pd-media reveal dari-kiri">
                    <div class="pd-img-box">
                        <img src="{{ asset('storage/image-product/' . $produk->image) }}" alt="{{ $produk->name }}">
                    </div>
                </div>
            </div>

            {{-- INFO --}}
            <div class="col-md-6">
                <h1 class="pd-title reveal dari-kanan" style="--d:.05s">{{ $produk->name }}</h1>

                <div class="reveal dari-kanan" style="--d:.15s">
                    <p class="pd-price-label">Harga</p>
                    <p class="pd-price">Rp {{ number_format($produk->price, 0, ',', '.') }}</p>
                </div>

                <hr class="pd-divider reveal" style="--d:.2s">

                <form id="formCart" action="{{ route('cart.store', Crypt::encrypt($produk->id)) }}" method="POST" class="reveal dari-kanan" style="--d:.25s">
                    @csrf

                    <label for="qty" class="pd-qty-label">Jumlah</label>
                    <div class="pd-qty">
                        <button type="button" id="qtyMinus" aria-label="Kurangi jumlah"><i class="fas fa-minus"></i></button>
                        <input type="number" id="qty" name="qty" value="1" min="1" max="99" inputmode="numeric">
                        <button type="button" id="qtyPlus" aria-label="Tambah jumlah"><i class="fas fa-plus"></i></button>
                    </div>

                    <p class="pd-total">Total: <strong id="total" data-harga="{{ (int) $produk->price }}">Rp {{ number_format($produk->price, 0, ',', '.') }}</strong></p>

                    <button type="submit" id="btnCart" class="btn btn-cart mt-3">
                        <span class="spin" aria-hidden="true"></span>
                        <i class="fas fa-cart-plus"></i>
                        <span>Tambahkan ke keranjang</span>
                    </button>
                </form>

                <ul class="pd-perks">
                    <li class="reveal dari-kanan" style="--d:.35s"><span class="pd-perk-icon"><i class="fas fa-hand-holding-heart"></i></span> Produk UMKM lokal asli</li>
                    <li class="reveal dari-kanan" style="--d:.43s"><span class="pd-perk-icon"><i class="fas fa-box-open"></i></span> Dikemas rapat agar tetap renyah</li>
                    <li class="reveal dari-kanan" style="--d:.51s"><span class="pd-perk-icon"><i class="fas fa-shipping-fast"></i></span> Dikirim langsung dari produsen</li>
                </ul>
            </div>
        </div>

        {{-- DESKRIPSI --}}
        <div class="row">
            <div class="col-lg-10">
                <div class="pd-desc reveal">
                    <h5>Deskripsi</h5>
                    <p>{!! nl2br(e($produk->description)) !!}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // ---------- Reveal ----------
        if (!reduce && 'IntersectionObserver' in window) {
            document.documentElement.classList.add('reveal-ready');
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (en) {
                    if (en.isIntersecting) { en.target.classList.add('tampil'); io.unobserve(en.target); }
                });
            }, { threshold: 0.12 });
            document.querySelectorAll('.reveal').forEach(function (el) { io.observe(el); });
        }

        // ---------- Jumlah + total ----------
        var qty = document.getElementById('qty');
        var total = document.getElementById('total');
        var harga = parseInt(total.dataset.harga, 10) || 0;

        function rupiah(n) { return 'Rp ' + n.toLocaleString('id-ID'); }

        function perbarui() {
            var n = parseInt(qty.value, 10);
            if (isNaN(n) || n < 1) n = 1;
            if (n > 99) n = 99;
            qty.value = n;
            total.textContent = rupiah(harga * n);
            total.classList.add('naik');
            setTimeout(function () { total.classList.remove('naik'); }, 200);
        }

        document.getElementById('qtyMinus').addEventListener('click', function () { qty.value = (parseInt(qty.value, 10) || 1) - 1; perbarui(); });
        document.getElementById('qtyPlus').addEventListener('click',  function () { qty.value = (parseInt(qty.value, 10) || 1) + 1; perbarui(); });
        qty.addEventListener('change', perbarui);

        // ---------- Tombol: tampilkan loading saat dikirim ----------
        document.getElementById('formCart').addEventListener('submit', function () {
            perbarui();
            var btn = document.getElementById('btnCart');
            setTimeout(function () {
                btn.classList.add('memuat');
                btn.setAttribute('disabled', 'disabled');
                btn.querySelector('span:last-child').textContent = 'Menambahkan...';
            }, 0);
        });
    })();
</script>
@endpush
