@extends('admin.template-admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Promo</h2>
    <form action="{{ route('admin-promo-update', Crypt::encrypt($promo->id)) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul Promo</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $promo->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Diskon (%)</label>
            <input type="number" class="form-control" name="discount" value="{{ old('discount', $promo->discount) }}" required min="0" max="100">
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $promo->start_date->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Berakhir</label>
            <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $promo->end_date->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Promo</label><br>
            @if($promo->image)
                <img src="{{ asset('storage/image-promo/' . $promo->image) }}" alt="Promo" width="100" class="mb-2">
            @endif
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
