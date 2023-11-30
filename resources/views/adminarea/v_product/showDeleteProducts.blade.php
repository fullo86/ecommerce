@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Data Produk Terhapus')
    
@section('showDeletedProductAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Produk Terhapus</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
        <div class="row">
          <div class="col-sm-6">
            <div id="toolbar">
              <a href="/admin-area/products" title="Kembali"> <button type="button" class="btn btn-primary">Kembali</button></a>
            </div>
          </div>
        </div>
        <table class="table table-bordered table-striped mb-none" id="table" data-toggle="table" data-pagination="true" data-search="true"  data-show-export="true"  data-toolbar="#toolbar">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <th>Tanggal Dihapus</th>
              <th class="actions-column">Aksi</th>        
          </tr>
          </thead>
          <tbody>
            @foreach ($productsDeleted as $product)
            <tr class="gradeX">
              <td>{{ $loop->iteration }}</td>
              <td>{{ $product->product_code }}</td>
              <td>{{ $product->product_name }}</td>
              <td>{{ \Carbon\Carbon::parse($product->deleted_at)->format('H:i:s d-m-Y') }}</td>
              <td>
                  <a href="/admin-area/restore/product/{{ $product->id }}" onclick="return confirm('Restore Produk {{ $product->product_name }}?')" class="mb-xs mt-xs mr-xs btn btn-xs btn-success edit-row">
                      <i class="fa fa-refresh"></i> Restore
                  </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
<!-- end: page -->
</section>
@endsection