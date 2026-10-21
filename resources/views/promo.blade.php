@extends('template')

@section('content')
<div class="container py-5 mt-5 ">
    <h2 class="mb-4">Promo Menarik untuk Anda</h2>

    @if($promos->isEmpty())
        <div class="alert alert-info">
            Belum ada promo yang tersedia saat ini.
        </div>
    @else
        <div class="row">
            @foreach($promos as $promo)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($promo->image)
                            <img src="{{ asset('storage/image-promo/'.$promo->image) }}" class="card-img-top" alt="Promo Image">
                        @else
                            <img src="{{ asset('images/default-promo.png') }}" class="card-img-top" alt="Default Promo">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $promo->title }}</h5>
                            <p class="card-text">Diskon: <strong>{{ $promo->discount }}%</strong></p>
                            <p class="card-text">
                                Periode:
                                {{ \Carbon\Carbon::parse($promo->start_date)->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}
                            </p>
                            <a href="{{ route('promo.addToCart', ['id' => Crypt::encrypt($promo->produk->id), 'discount' => $promo->discount]) }}" class="btn btn-warning">Tambahkan ke keranjang</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
