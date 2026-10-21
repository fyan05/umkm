@extends('template')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="{{ asset('storage/image-product/' . $produk->image) }}" class="img-fluid" style="max-height: 400px;" alt="{{ $produk->nama }}">
        </div>
        @csrf

        <div class="col-md-6">
            <h2>{{ $produk->name }}</h2>
            <h4 class="text-muted">Rp {{ number_format($produk->price, 0, ',', '.') }}</h4>
            <form action="{{ route('cart.store', Crypt::encrypt($produk->id)) }}" method="POST">
                @csrf
                <input type="hidden" name="qty" value="1">
                <button type="submit" class="btn btn-warning">Tambahkan ke keranjang</button>
            </form>
            <div class="mt-4">
                <h5>Deskripsi</h5>
                <p>{{ $produk->description }}</p>

            </div>
        </div>
    </div>
</div>
@endsection
