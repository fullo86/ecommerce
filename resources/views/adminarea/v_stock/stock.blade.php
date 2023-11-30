@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Stok Produk')
    
@section('stockAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Data Stok Produk</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
        <div class="row">
          <div class="col-sm-6">
          </div>
        </div>
        @if (Session::has('status'))
          <div id="flashMessage" class="alert alert-{{ Session::get('status') == 'success' ? 'success' : 'danger' }}">
            {{ Session::get('message') }}
          </div>
        @endif
        <table
          class="table table-bordered table-striped mb-none" id="table" data-toggle="table" data-pagination="true" data-search="true"  data-show-export="true"  data-toolbar="#toolbar">
          <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kode Produk</th>
                <th class="text-center">Ukuran</th>
                <th class="text-center">Stok</th>
                <th class="text-center">Status</th>
                <th class="actions-column">Aksi</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($stocks as $stock)
            <tr class="gradeX">
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $stock->product_code }}</td>
                <td class="text-center">
                  @foreach ($stock->sizes as $row)
                      - {{$row->size_name}} <br>
                  @endforeach
                </td>
                <td class="text-center">{{ $stock->stock }}</td>
                <td class="text-center">{{ $stock->status_stock }}</td>
                <td>
                    <a href="/admin-area/edit/stock/{{ $stock->id }}" class="mb-xs mt-xs mr-xs btn btn-xs btn-info edit-row">
                        <i class="fa fa-pencil"></i> Edit
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