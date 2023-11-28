@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Edit Stock Produk')
    
@section('editStockAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Stock Produk</h2>
    </header>
    <div class="panel-body">
        <h4 class="mb-2">Edit Stock Produk</h4>
        <form class="form-horizontal form-bordered" action="/admin-area/edit/stock/update/{{ $stockValue->id }}" method="post">
            @csrf
            @method('patch')
            <div class="form-group">
                <label class="col-md-3 control-label" for="stock"></label>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="stock" placeholder="Masukan Stok Produk" id="stock" value="{{ $stockValue->stock }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="5" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <a href="/admin-area/stocks" class="btn btn-primary col-md-12">Batal</a>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary col-md-12">Update</button>    
                </div>
            </div>    
        </form>
    </div>
@endsection
