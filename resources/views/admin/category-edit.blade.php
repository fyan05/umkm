@extends('admin.template-admin')
@section('content')
<link rel="stylesheet" href="{{asset('bootstrap1/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/style.css')}}">
<div class="container mt-4">
    <h4>edit kategori</h4>
    <hr>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show ">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>validete invalid</strong>
        <ul>
            @foreach ($errors->all() as $item )
            <li>{{$item}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('admin.category.update',Crypt::encrypt($category->id))}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-3 mb-3">
            <label for="name" class="form-label">nama produk</label>
            <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">
        </div>
        <div class="mb-3 mt-3">
            <input type="submit" value="SAVE" class="btn btn-primary w-100">
        </div>
    </form>
</div>
@endsection
