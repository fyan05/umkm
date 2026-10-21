@extends('template')

@section('content')
<div class="container">
   <style>
    .profile-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .profile-card {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 12px;
        max-width: 400px;
        text-align: center;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
    }
</style>

<div class="container profile-container p-5 mt-5">
    <div class="profile-card">
         <h2>Profil Saya</h2>
         <img src="{{ asset('storage/image-member/'.$member->image) }}" alt="Profile Image" class="profile-image">
         <p><strong>Nama:</strong> {{ $member->name }}</p>
         <p><strong>Tanggal Lahir:</strong> {{ $member->birthday }}</p>
         <p><strong>Nomor Telepon:</strong> {{ $member->number_phone }}</p>
         <p><strong>Alamat:</strong> {{ $member->address }}</p>
         <p><strong>Gender:</strong> {{ $member->gender }}</p>
    </div>
</div>

</div>
@endsection
