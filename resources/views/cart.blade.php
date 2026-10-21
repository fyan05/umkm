@extends('template')
@section('content')
<div class="container py-5 mt-5">
    <h2 class="mb-4">Cart</h2>
    <br>
    <div class="table-responsive">
        <table class="table align-middle table table-bordered">
            <thead class="table-light">
                @csrf
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($cart as $item)
                <tr>
                    <td>
                        <div class="d-flex align-item-center">
                            <img src="{{ asset('storage/image-product/' .$item->produk->image) }}" width="100"height="100" style="object-fit:cover;border-radius: 8px; class="mt-3" alt="Card image">
                            <div class="p-2">
                                <h6 class="mb-8">{{ $item->produk->name }}</h6>
                                <small>{{ $item->produk->description }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $item->produk->price }}</td>
                    <td>
                        <input type="number" class="from-control" value="{{ $item->qty }}" min="1" style="width: 80px">
                    </td>
                    <td>{{ $item->qty * $item->produk->price }}</td>
                    <td>
                        <form action="{{ route('cart.delete', Crypt::encrypt($item->id)) }}" method="POST">
                           @csrf
                           <input type="hidden" name="delete" value="1">
                           <button type="submit" class="btn btn-danger">Hapus</button>
                       </form>
                    </td>
                </tr>
                @php
                    $total = $total + ($item->qty*$item->produk->price);
                @endphp
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="/" class="btn btn-outline-secondary">lanjut belanja</a>
        <div>

            <h5>Total: <strong>{{ $total }}</strong></h5>
            <a href="/checkout" class="btn btn-primary">Checkout</a>
        </div>
    </div>
</div>
@endsection
