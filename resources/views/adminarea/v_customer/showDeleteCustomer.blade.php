@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Data Customer Terhapus')
    
@section('showDeletedCustomerAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Customer Terhapus</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
              <div id="toolbar">
                <a href="/admin-area/customer" title="Kembali"> <button type="button" class="btn btn-primary">Kembali</button></a>
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
                <th>Username</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Tanggal Dihapus</th>
                <th class="actions-column">Aksi</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($customerDeleted as $customer)
                <tr class="gradeX">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $customer->username }}</td>
                  <td>{{ $customer->phone }}</td>
                  <td>{{ $customer->email }}</td>
                  <td>{{ \Carbon\Carbon::parse($customer->deleted_at)->format('H:i:s d-m-Y') }}</td>
                  <td>
                    <a href="/admin-area/restore/customer/{{ $customer->id }}" onclick="return confirm('Restore Customer {{ $customer->name }}?')" class="mb-xs mt-xs mr-xs btn btn-xs btn-success edit-row">
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