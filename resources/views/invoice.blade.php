@extends('template')


@section('content')
  <div class="container py-5 mt-5">
     <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Pesanan</h4>
        <a href="{{ route('invoice.detail') }}" class="btn btn-primary">Lihat detail pesanan</a>
    </div>
        <hr>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No Invoice</th>
                        <th>Date</th>
                        <th>Due Date</th>
                        <th>Status invoice</th>
                        <th>Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice as $item)
                        <tr>
                            <td>{{ $item->no_invoice }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->expired_date }}</td>
                            <td>
                                @if ($item->proof =='-')
                                    {{ 'Belum di bayar' }}
                                @else
                                    @if ($item->status == 0)
                                        {{ 'Harap Tunggu' }}
                                    @else
                                        {{ 'Sudah di bayar dan akan di kirim kan' }}
                                    @endif
                                @endif
                            <td>
                                <img src="{{ asset('storage/invoices/' . $item->proof) }}" style="width: 100px;height:100px"
                                    class="me-3" alt="Produk">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
