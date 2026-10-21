@extends('admin.template-admin')

@section('content')
<div class="container mt -4">
    <h2>Data Kategori</h2>
    <a href="/admin/category/create" class="btn btn-info">Tambah Data</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <td>Category</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $row)
            <tr>
                <td>{{ $row->name }}</td>
                <td>

                        @csrf
                     <a href="{{ route('admin.category.edit', Crypt::encrypt($row->id)) }}" class="btn btn-info">Update</a>
                    <a href="{{ route('admin.category.delete', Crypt::encrypt($row->id)) }}" class="btn btn danger"onclick="return confirm('Yakin?')">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
