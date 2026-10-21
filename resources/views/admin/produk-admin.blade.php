@extends('admin.template-admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Produk</h4>
        <a href="{{ route('produk-create') }}" class="btn btn-primary">New Product</a>
    </div>
    <hr>
    @if(Session::get('success') !== null)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif
    <table class="table table-striped">

        <thead>
            <tr>
                <td>No</td>
                <td>Name Product</td>
                <td>Price</td>
                <td>Description</td>
                <td>Category Name</td>
                <td>Image</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
        @foreach ($produk as  $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ optional($item->category)->name ?? '-' }}</td>
            <td>
                <img src="{{ asset('storage/image-product/'. $item->image) }}" alt="" width="100"height="100" style="object-fit:cover;border-radius: 8px;">
            </td>
            <div class="flex space-x-2">
                <td>
                    <a href="{{ route('produk.edit',Crypt::encrypt($item->id)) }}"class="btn btn-info">Edit</a>
                    <a href="{{ route('produk.delete',Crypt::encrypt($item->id)) }}"class="btn btn-danger" onclick="return  confirm('Delete this data')">delete</a>
                </td>
            </div>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
