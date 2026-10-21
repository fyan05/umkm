@extends('template')

@section('content')
<div class="container">
    <h2>Edit Profil</h2>
    <a href="{{ route('profile') }}" class="btn btn-secondary mb-3">Kembali</a>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
     @endif


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('profile-update', Crypt::encrypt($member->id)) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $member->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Foto</label><br>
            @if($member->image)
                <img src="{{ asset('storage/image-member/' . $member->image) }}" width="100">
            @endif
            <input type="file" name="image" class="form-control mt-2">
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="birthday" value="{{ $member->birthday }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nomor Telepon</label>
            <input type="text" name="number_phone" value="{{ $member->number_phone }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control">{{ $member->address }}</textarea>
        </div>

        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="">Pilih</option>
                <option value="Laki-laki" {{ $member->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $member->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
