@extends('admin.template-admin')
@section('content')
<div class="container">
    <h4>Edit Member</h4>
    <hr>
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
    <pre>{{ dd($member) }}</pre>
    <form action="{{route('admin.member.update', Crypt::encrypt($member->id))  }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control"value="{{ old('name', $member->name) }}">
        </div>
        <div class="mb-3 mt-3">
            <label for="price" class="form-label">Number Phone</label>
            <input type="number_phone" name="number_phone" id="number_phone" class="form-control"min="0"value="{{ old('number_phone', $member->number_phone) }}">
        </div>
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control"value="{{ old('address', $member->address) }}">
        </div>
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Birthday</label>
            <input type="date" name="birthday" id="birthday" class="form-control"value="{{ old('birthday', $member->birthday) }}">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
                <select name="gender" class="form-control">
                    <option value="L" {{ $member->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $member->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
        </div>
        <div class="form-group">
            <label for="level" class="form-label">Level</label>
            <select name="level" class="form-control">
                <option value="Admin" {{ $member->Level == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Member" {{ $member->Level == 'Member' ? 'selected' : '' }}>Member</option>
            </select>
        </div>
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $member->user->email) }}">
        </div>
        <div class="mb-3 mt-3">
            <label for="price" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control"min="0">
        </div>
        <div class="mb-3 mt-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="mt-3 mb-3">
            <input type="submit" value="update" class="btn btn-primary w-100">
        </div>

    </form>
</div>
@endsection
