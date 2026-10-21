@extends('admin.template-admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Daftar Promo</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin-promo-create') }}" class="btn btn-primary mb-3">Tambah Promo</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Diskon</th>
                    <th>Tanggal</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($promo as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->discount }}%</td>
                        <td>{{ $item->start_date->format('d M Y') }} - {{ $item->end_date->format('d M Y') }}</td>
                        <td>
                            <img src="{{ asset('storage/image-promo/' . $item->image) }}" width="80" alt="Promo">
                        </td>
                        <td>
                            @if(now()->between($item->start_date, $item->end_date))
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin-promo-edit', Crypt::encrypt($item->id)) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin-promo-delete', Crypt::encrypt($item->id)) }}"class="d-inline" onsubmit="return confirm('Yakin ingin hapus promo ini?')">
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Belum ada promo</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
