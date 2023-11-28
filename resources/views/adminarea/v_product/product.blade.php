@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Produk')
    
@section('productAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Data Produk</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
        <div class="row">
          <div class="col-sm-6">
            <div id="toolbar">
              <a href="/admin-area/create/product" title="Tambah Produk"> <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah</button></a>
              @if (Auth::user()->role_id == 1)
                <a href="/admin-area/delete/products/show" title="Daftar Kategori Yang Terhapus"> <button type="button" class="btn btn-dark"><i class="fa fa-archive"></i> Data Terhapus</button> </a>                  
              @endif
            </div>
          </div>
        </div>
        @if (Session::has('status'))
          <div class="alert {{ Session::get('status') == 'success' ? 'alert-success' : 'alert-failed' }}">
              {{ Session::get('message') }}
          </div>
        @endif
        <table class="table table-bordered table-striped mb-none" id="table" data-toggle="table" data-pagination="true" data-search="true"  data-show-export="true"  data-toolbar="#toolbar">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <th>Status</th>
              <th class="actions-column">Aksi</th>        
          </tr>
          </thead>
          <tbody>
            @foreach ($listProducts as $product)
            <tr class="gradeX">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $product->product_code }}</td>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->status_product }}</td>
              <td>
                  <a href="/admin-area/edit/product/{{ $product->id }}" class="mb-xs mt-xs mr-xs btn btn-xs btn-info edit-row">
                      <i class="fa fa-pencil"></i> Edit
                  </a>

                  <a href="/admin-area/edit/product/{{ $product->id }}" class="mb-xs mt-xs mr-xs btn btn-xs btn-warning edit-row">
                      <i class="fa fa-eye"></i> Detail
                  </a>

                  <form action="/admin-area/delete/product/{{ $product->id }}" method="post" class="d-inline mb-xs mt-xs mr-xs btn btn-xs btn-danger remove-row">
                    @method('delete')
                    @csrf
                    <button onclick="return confirm('Yakin Mau Hapus Produk {{ $product->product_name }}?')" style="color: white;" type="submit">
                        <i class="fa fa-trash-o"></i> Hapus
                    </button>
                  </form>
                  @if ($product->status_product == 'published')
                  <form action="/admin-area/change-status/product/{{ $product->id }}" method="post" class="d-inline mb-xs mt-xs mr-xs btn btn-xs btn-primary remove-row">
                    @method('patch')
                    @csrf
                    <button style="color: white;" type="submit">
                        <i class="fa fa-exclamation-circle"></i> Unpublish
                    </button>
                  </form>
                @else
                  <form action="/admin-area/change-status/product/{{ $product->id }}" method="post" class="d-inline mb-xs mt-xs mr-xs btn btn-xs btn-primary remove-row">
                    @method('patch')
                    @csrf
                    <button style="color: white;" type="submit">
                        <i class="fa fa-check"></i> Publish
                    </button>
                  </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
<!-- end: page -->
</section>
@endsection