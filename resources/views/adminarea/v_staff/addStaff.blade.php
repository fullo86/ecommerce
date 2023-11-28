@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Tambah Staff')
    
@section('addStaffAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Tambah Staff</h2>
    </header>

    <div class="panel-body">
        <h4 class="mb-2">Tambah Staff</h4>
        <form class="form-horizontal form-bordered" action="/admin-area/create/staff/save" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row col-md-12">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="username">Username</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username" id="username" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="name">Nama Lengkap</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Lengkap" id="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="name">Password</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="password" placeholder="Masukan Password" id="password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="phone">No Handphone</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="phone" placeholder="Masukan No Handphone" id="phone" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="phone">Email</label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email" id="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="address">Alamat</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name="address" placeholder="Masukan Alamat" id="address" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <a href="/admin-area/staff" class="btn btn-primary col-md-12 col-xs-12">Batal</a>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button type="submit" class="btn btn-primary col-md-12 col-xs-12">Tambah</button>    
                    </div>
                </div>        
            </div>
        </form>
    </div>
@endsection