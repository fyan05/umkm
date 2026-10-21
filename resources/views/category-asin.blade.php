@extends('template')
@section('content')
    <div class="container py-5 mt-5">
    <h2 class="text-center fw-bold mb-2">Produk <span class="text-primary">Asin/Gurih</span></h2>
    <p class="text-center mb-4"></p>
    <div class="row g-4 justify-content-center">
        @forelse($produk as $produk)
        @if ($produk->categories_id == '1')
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ asset('storage/image-product/' . $produk->image) }}" class="card-img-top" alt="{{ $produk->name }}" style="object-fit: cover; height: 220px;">
                <div class="card-body text-center">
                    <h6 class="card-title mb-2">{{ $produk->name }}</h6>
                    <p class="card-text text-primary fw-semibold">Rp{{ number_format($produk->price, 0, ',', '.') }}</p>
                    <a href="{{ route('produk.detail',Crypt::encrypt($produk->id)) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endif
        @empty
            <p class="text-center">Tidak ada produk tersedia.</p>
        @endforelse
    </div>
</div>
@endsection
