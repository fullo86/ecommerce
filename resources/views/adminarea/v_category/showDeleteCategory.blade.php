@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Data Kategori Terhapus')
    
@section('showDeletedCategoryAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Kategori Terhapus</h2>
    </header>

    <!-- start: page -->
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
              <div id="toolbar">
                <a href="/admin-area/category" title="Kembali"> <button type="button" class="btn btn-primary">Kembali</button> </a>
              </div>
            </div>
          </div>
        <table class="table table-bordered table-striped mb-none" id="table" data-toggle="table" data-pagination="true" data-search="true"  data-show-export="true"  data-toolbar="#toolbar">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Tanggal Dihapus</th>
            <th class="actions-column">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categoryDeleted as $category)
        <tr class="gradeX">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->category_name }}</td>
            <td>{{ \Carbon\Carbon::parse($category->deleted_at)->format('H:i:s d-m-Y') }}</td>
            <td>
                <a href="/admin-area/restore/category/{{ $category->id }}" onclick="return confirm('Restore Kategori {{ $category->category_name }}?')" class="mb-xs mt-xs mr-xs btn btn-xs btn-success edit-row">
                    <i class="fa fa-refresh"></i> Restore
                </a>
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
@endsection
