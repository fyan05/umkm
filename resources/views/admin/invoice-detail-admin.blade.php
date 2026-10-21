@extends('admin.template-admin')
@section('content')
 <div class="container py-5 mt-5">
        <h2 class="mb-4">Invoice Detail</h2>
        <hr>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Handphone</th>
                        <th>Produk</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Total</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($invoice as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                             <td>
                                {{$item->invoice->member->name}}
                            </td>
                            <td>
                                {{$item->invoice->member->address}}
                            </td>
                            <td>
                                {{$item->invoice->member->number_phone}}
                            </td>
                            <td>{{ $item->produk->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->qty }}</td>
                            <td><img src="{{ asset('storage/image-product/' . $item->produk->image) }}"width="100"height="100" style="object-fit:cover;border-radius: 8px;"
                                    class="me-3" alt="Produk">
                            </td>
                             @php
                                $total = $total + ($item->qty*$item->produk->price);
                            @endphp
                            <td> Total: Rp. {{ number_format($total,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
