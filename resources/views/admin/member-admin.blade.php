@extends('admin.template-admin')
@section('content')
<div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Member</h4>
        <a href="{{ route('adminmc') }}" class="btn btn-primary">New Member</a>
    </div>
    <hr>
    @if (Session::get('success'))
    <div class="alert alert-success">
        {{ Session('success') }}
    </div>
    @endif
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Name Member</th>
                <th>No hp</th>
                <th>Address</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Level</th>
                <th>Id</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $members as $item )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->number_phone }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->user->email }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->user->Level }}</td>
                    <td>{{ $item->user->id }}</td>
                    <td>
                       <img src="{{ asset('storage/image-member/'. $item->image) }}" alt="" width="100"height="100" style="object-fit:cover;border-radius: 8px;">
                    </td>
                    <td>
                        <a href="{{ route('admin.member.edit',Crypt::encrypt($item->id)) }}"class="btn btn-info">Edit</a>
                        <a href="{{ route('admin.member.delete',Crypt::encrypt($item->id)) }}"class="btn btn-danger" onclick="return  confirm('Delete this data')">delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
