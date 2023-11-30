@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Edit Kategori')
    
@section('editCategoryAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Kategori</h2>
    </header>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel-body">
        <h4 class="mb-2">Edit Kategori</h4>
        <form class="form-horizontal form-bordered" action="/admin-area/edit/category/update/{{ $category->id }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label class="col-md-3 control-label" for="category_name"></label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="category_name" placeholder="Masukan Nama Kategori" id="category_name" value="{{ $category->category_name }}" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <a href="/admin-area/category" class="btn btn-primary col-md-12">Batal</a>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary col-md-12">Update</button>    
                </div>
            </div>    
        </form>
    </div>
@endsection
