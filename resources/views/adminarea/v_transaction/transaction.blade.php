@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Transaksi')
    
@section('transactionAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Data Transaksi</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-6">
          <div id="toolbar">
            @if (Auth::user()->role_id == 1)
              <a href="/admin-area/delete/transaction/show" title="Daftar Transaksi Yang Terhapus"> <button type="button" class="btn btn-dark"><i class="fa fa-archive"></i> Data Terhapus</button> </a>
            @endif
          </div>
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
                <th>No</th>
                <th>Order ID</th>
                <th>Nama</th>
                <th>No Handphone</th>
                <th>Email</th>
                <th>Alamat</th>
                <th class="actions-column">Aksi</th>
          </tr>
          </thead>
          <tbody>
            {{-- @dd($city) --}}
            @foreach ($listTransaction as $trx)
                  <tr class="gradeX">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $trx->order_id }}</td>
                    <td>
                      @if ($trx->recipient_name == null)
                          @if ($trx->customer_id == $trx->customer->id)
                            {{ $trx->customer->name }}
                          @endif
                      @else
                        {{ $trx->recipient_name }}
                      @endif
                    </td>
                    <td>{{ $trx->phone }}</td>
                    <td>{{ $trx->email }}</td>
                    <td>
                      @foreach ($cities as $city)
                        @if ($trx->city_id == $city['city_id'])
                          {{ $trx->address.', '.$city['city_name'].', '.$city['province'] }}
                        @endif
                      @endforeach
                    </td>
                    <td>
                      <a href="/admin-area/transaction/{{ $trx->order_id }}" class="mb-xs mt-xs mr-xs btn btn-xs btn-warning edit-row">
                          <i class="fa fa-eye"></i> Detail
                      </a>
                      <a href="/admin-area/transaction/invoice/{{ $trx->order_id }}" class="mb-xs mt-xs mr-xs btn btn-xs btn-primary edit-row">
                          <i class="fa fa-print"></i> Invoice
                      </a>
                      <form action="/admin-area/delete/transaction/{{ $trx->id }}" method="post" class="d-inline mb-xs mt-xs mr-xs btn btn-xs btn-danger remove-row">
                        @method('delete')
                        @csrf
                        <button onclick="return confirm('Yakin Mau Hapus Transaksi {{ $trx->order_id }} ?')" style="color: white;" type="submit">
                            <i class="fa fa-trash-o"></i> Hapus
                        </button>
                      </form>  
                    </td>
                  </tr>                        
            @endforeach
          </tbody>
        </table>
      </div>
<!-- end: page -->
  </section>
@endsection