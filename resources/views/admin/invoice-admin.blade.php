@extends('admin.template-admin')

@section('content')
    <div class="container py-5">
         <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Pesanan</h4>
        <a href="{{ route('invoice.detailadmin') }}" class="btn btn-primary">Detail</a>

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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice as $item)
                    <form method="post" action="/invoice/update/{{ Crypt::encrypt($item->no_invoice) }}">
                        @csrf
                        <tr>
                            <td>{{ $item->no_invoice }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->expired_date }}</td>
                            <td>
                                <select name="status" id="status">
                                    <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Belum Bayar
                                    </option>
                                    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Sudah Bayar
                                    </option>
                                </select>
                             <td>
                                <img src="{{ asset('storage/invoices/' . $item->proof) }}" style="width: 100px;height:100px"
                                    class="me-3" alt="Produk">
                            </td>
                            <td>
                                <input type="submit" value="Ubah Status" name="ubah" class="btn btn-sm btn-warning">
                            </td>
                        </tr>
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
