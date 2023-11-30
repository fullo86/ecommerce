@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Staff')
    
@section('staffAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Data Staff</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
        <div class="row">
          <div class="col-sm-6">
            <div id="toolbar">
              <a href="/admin-area/create/staff" title="Tambah Staff"> <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah</button> </a>
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
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th class="staff-actions-column">Aksi</th>
          </tr>
          </thead>
          <tbody {{$no=1}}>
            @foreach ($listStaff as $staff)
                @if ($staff->role_id == 2)
                  <tr class="gradeX">
                    <td>{{ $no++ }}</td>
                    <td>{{ $staff->username }}</td>
                    <td>{{ $staff->email }}</td>
                    <td>{{ $staff->active_status }}</td>
                    <td>
                        <a href="/admin-area/edit/staff/{{ $staff->id }}" class="mb-xs mt-xs mr-xs btn btn-xs btn-info edit-row">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                        <a href="/admin-area/detail/category/{{ $staff->id }}" class="mb-xs mt-xs mr-xs btn btn-xs btn-warning edit-row">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                        <form action="/admin-area/delete/staff/{{ $staff->id }}" method="post" class="d-inline mb-xs mt-xs mr-xs btn btn-xs btn-danger remove-row">
                          @method('delete')
                          @csrf
                          <button onclick="return confirm('Yakin Mau Hapus kategori {{ $staff->username }}?')" style="color: white;" type="submit">
                              <i class="fa fa-trash-o"></i> Hapus
                          </button>
                        </form>
                        @if ($staff->active_status == 'active')
                          <form action="/admin-area/change-status/staff/{{ $staff->id }}" method="post" class="d-inline mb-xs mt-xs mr-xs btn btn-xs btn-primary remove-row">
                            @method('patch')
                            @csrf
                            <button style="color: white;" type="submit">
                                <i class="fa fa-exclamation-circle"></i> Nonaktif
                            </button>
                          </form>
                        @else
                          <form action="/admin-area/change-status/staff/{{ $staff->id }}" method="post" class="d-inline mb-xs mt-xs mr-xs btn btn-xs btn-primary remove-row">
                            @method('patch')
                            @csrf
                            <button style="color: white;" type="submit">
                                <i class="fa fa-check"></i> Aktif
                            </button>
                          </form>
                        @endif
                    </td>
                  </tr>                        
                @endif
            @endforeach
          </tbody>
        </table>
      </div>
<!-- end: page -->
  </section>
@endsection