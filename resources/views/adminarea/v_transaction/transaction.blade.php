@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Transaksi')
    
@section('transactionAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Data Transaksi</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
        {{-- <div class="row">
          <div class="col-sm-6">
            <div id="toolbar">
              <a href="/admin-area/create/staff" title="Tambah Staff"> <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah</button> </a>
            </div>
          </div>
        </div> --}}
        @if (Session::has('status'))
          <div class="alert {{ Session::get('status') == 'success' ? 'alert-success' : 'alert-failed' }}">
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
                <th>Aksi</th>
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
                    </td>
                  </tr>                        
            @endforeach
          </tbody>
        </table>
      </div>
<!-- end: page -->
  </section>
@endsection