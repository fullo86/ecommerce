@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Data Kategori Terhapus')
    
@section('showDeletedTransactionAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Transaksi Terhapus</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-6">
          <div id="toolbar">
            <a href="/admin-area/transaction" title="Kembali"> <button type="button" class="btn btn-primary">Kembali</button> </a>
        </div>
        </div>
      </div>
        <table
          class="table table-bordered table-striped mb-none" id="table" data-toggle="table" data-pagination="true" data-search="true"  data-show-export="true"  data-toolbar="#toolbar">
          <thead>
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Nama</th>
                <th>No Handphone</th>
                <th>Email</th>
                <th>Tanggal Dihapus</th>
                <th class="actions-column">Aksi</th>
          </tr>
          </thead>
          <tbody>
            {{-- @dd($city) --}}
            @foreach ($trxDeleted as $trx)
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
                    <td>{{ \Carbon\Carbon::parse($trx->deleted_at)->format('H:i:s d-m-Y') }}</td>
                    <td>
                        <a href="/admin-area/restore/transaction/{{ $trx->id }}" onclick="return confirm('Restore Transaksi {{ $trx->order_id }}?')" class="mb-xs mt-xs mr-xs btn btn-xs btn-success edit-row">
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