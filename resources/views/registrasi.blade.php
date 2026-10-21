@extends('admin.template-login')
@section('content')
<div class="container">
    <h4>Create Member</h4>
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
    <form action="{{route('regis.post')  }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3 mt-3">
            <label for="price" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control"min="0">
        </div>
        <div class="mb-3 mt-3">
            <label for="price" class="form-label">Number Phone</label>
            <input type="number_phone" name="number_phone" id="number_phone" class="form-control"min="0">
        </div>
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Birthday</label>
            <input type="date" name="birthday" id="birthday" class="form-control">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
                <select name="gender" class="form-control">
                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
        </div>
         <div class="mb-3 mt-3">
            <label for="image" class="form-label">Image </label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="mt-3 mb-3">
            <input type="submit" value="save" class="btn btn-primary w-100">
        </div>
    </form>
</div>
@endsection
