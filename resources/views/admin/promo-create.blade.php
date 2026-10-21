@extends('admin.template-admin')

@section('content')
<div class="container mt-4">
    <h2>Tambah Promo</h2>
       @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Validate Invalid</strong>
            <ul>
                @foreach ($errors->all() as $item )
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
    </div>
    @endif
    <form action="{{ route('admin-promo-post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Promo</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Diskon (%)</label>
            <input type="number" class="form-control" name="discount" value="{{ old('discount') }}" required min="0" max="100">
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" name="start_date" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Berakhir</label>
            <input type="date" class="form-control" name="end_date" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Promo</label>
            <input type="file" class="form-control" name="image" accept="image/*" required>
        </div>
        <div class="mb-3">
            <select name="produks_id" class="form-control" required>
                <option value="">Pilih Produk</option>
                @foreach($products as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
