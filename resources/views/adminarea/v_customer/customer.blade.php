@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Customer')
    
@section('customerAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Data Customer</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-6">
          <div id="toolbar">
            @if (Auth::user()->role_id == 1)
              <a href="/admin-area/delete/customer/show" title="Daftar Customer Yang Terhapus"> <button type="button" class="btn btn-dark"><i class="fa fa-archive"></i> Data Terhapus</button></a>
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
                <th>Username</th>
                <th>No HP</th>
                <th>Email</th>
                <th class="actions-column">Aksi</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($listCustomers as $customer)
                <tr class="gradeX">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $customer->username }}</td>
                  <td>{{ $customer->phone }}</td>
                  <td>{{ $customer->email }}</td>
                  <td>
                    <a href="/admin-area/edit/customer/{{ $customer->id }}" class="mb-xs mt-xs mr-xs btn btn-xs btn-info edit-row">
                        <i class="fa fa-pencil"></i> Edit
                    </a>

                    <a href="/admin-area/detail/category/" class="mb-xs mt-xs mr-xs btn btn-xs btn-warning edit-row">
                        <i class="fa fa-eye"></i> Detail
                    </a>

                    <form action="/admin-area/delete/customer/{{ $customer->id }}" method="post" class="d-inline mb-xs mt-xs mr-xs btn btn-xs btn-danger remove-row">
                      @method('delete')
                      @csrf
                      <button onclick="return confirm('Yakin Mau Hapus Customer {{ $customer->name }}?')" style="color: white;" type="submit">
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