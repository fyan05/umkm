@extends('admin.template-admin')

@section('title', 'Daftar Pesanan')

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Status</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name ?? '-' }}</td>
            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
            <td><span class="badge bg-info">{{ $order->status }}</span></td>
            <td>{{ $order->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('admin.orders-show', $order->id) }}" class="btn btn-sm btn-primary">Lihat</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $orders->links() }}
@endsection
