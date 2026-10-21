@extends('admin.template-admin')
@section('content')
<div class="container">
    <h4>Create Product</h4>
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
    <form action="{{route('produk-create-post')  }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name Product</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="mb-3 mt-3">
            <label for="price" class="form-label">Price Product</label>
            <input type="number" name="price" id="price" class="form-control ">
        </div>
        <div class="mb-3 mt-3">
            <label for="description" class="form-label">Description Product</label>
            <textarea name="description" id="description" rows="5" class="form-control"></textarea>
        </div>
        <div class="mb-3 mt-3">
            <label for="image" class="form-label">Image Product</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="mb-3 mt-3">
            <label for="categories_id" class="form-label">Category</label>
            <select name="categories_id" id="categories_id" class="form-select">
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-3 mb-3">
            <input type="submit" value="save" class="btn btn-primary w-100">
        </div>
    </form>
</div>
@endsection
