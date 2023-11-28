@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Ganti Password')
    
@section('changePasswordStaff')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Ganti Password</h2>
    </header>
    <div class="panel-body">
        @if (Session::has('status'))
            <div class="alert {{ Session::get('status') == 'success' ? 'alert-success' : 'alert-failed' }}">
                {{ Session::get('message') }}
            </div>
        @endif
        <h4 class="mb-2">Ganti Password</h4>
        @if (Auth::user()->role_id == 1)        
        <form class="form-horizontal form-bordered" action="/admin-area/staff/change/password/update/{{ $staffData->id }}" method="post">
            @csrf
            @method('patch')
            <div class="row col-md-12">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="username">Password</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="password" placeholder="Masukan Password Baru" id="password" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <a href="/administrator/dashboard" class="btn btn-primary col-md-12 col-xs-12">Batal</a>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button type="submit" class="btn btn-primary col-md-12 col-xs-12">Update</button>    
                    </div>
                </div>        
            </div>
        </form>            
        @else
        <form class="form-horizontal form-bordered" action="/admin-area/staff/change-password/update/{{ $staffData->id }}" method="post">
            @csrf
            @method('patch')
            <div class="row col-md-12">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="username">Password</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="password" placeholder="Masukan Password Baru" id="password" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <a href="/administrator/dashboard" class="btn btn-primary col-md-12 col-xs-12">Batal</a>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button type="submit" class="btn btn-primary col-md-12 col-xs-12">Update</button>    
                    </div>
                </div>        
            </div>
        </form>            
        @endif
    </div>
@endsection