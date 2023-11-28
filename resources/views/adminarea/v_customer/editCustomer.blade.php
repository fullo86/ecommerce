@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Edit Customer')
    
@section('editCustomerAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Customer</h2>
    </header>
<p>{{$customerValue}}</p>
    <div class="panel-body">
        <h4 class="mb-2">Edit Customer</h4>
        <form class="form-horizontal form-bordered" action="/admin-area/edit/customer/update/{{ $customerValue->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row col-md-12">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="username">Username</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username" id="username" value="{{ $customerValue->username }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="name">Nama Lengkap</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Lengkap" id="name" value="{{ $customerValue->name }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="phone">No Handphone</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="phone" placeholder="Masukan No Handphone" id="phone" value="{{ $customerValue->phone }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="phone">Email</label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email" id="email" value="{{ $customerValue->email }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="address">Alamat</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name="address" placeholder="Masukan Alamat" id="address" required>{{ $customerValue->address }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Foto Profile Staff</label>
                    <div class="col-md-10">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                <img src="{{ asset('storage/images/profile/'.$customerValue->image_profile) }}" alt="image_profile" width="100px" height="150px" style="margin-bottom: 5px;">
                                <div class="uneditable-input">
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <input type="file" name="image_profile" id="image_profile" value="{{ $customerValue->image_profile }}"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <a href="/admin-area/customer" class="btn btn-primary col-md-12 col-xs-12">Batal</a>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button type="submit" class="btn btn-primary col-md-12 col-xs-12">Update</button>    
                    </div>
                </div>        
            </div>
        </form>            
    </div>
@endsection