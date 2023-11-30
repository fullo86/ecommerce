@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Edit Staff')
    
@section('editStaffAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Edit Staff</h2>
    </header>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel-body">
        <h4 class="mb-2">Edit Staff</h4>
        @if (Auth::user()->role_id == 1)
        <form class="form-horizontal form-bordered" action="/admin-area/edit/staff/update/{{ $staffValue->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row col-md-12">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="username">Username</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username" id="username" value="{{ $staffValue->username }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="name">Nama Lengkap</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Lengkap" id="name" value="{{ $staffValue->name }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="phone">No Handphone</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="phone" placeholder="Masukan No Handphone" id="phone" value="{{ $staffValue->phone }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="phone">Email</label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email" id="email" value="{{ $staffValue->email }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="address">Alamat</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name="address" placeholder="Masukan Alamat" id="address" required>{{ $staffValue->address }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Foto Profile Staff</label>
                    <div class="col-md-10">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                <img src="{{ asset('storage/images/profile/'.$staffValue->image_profile) }}" alt="image_profile" width="100px" height="150px" style="margin-bottom: 5px;">
                                <div class="uneditable-input">
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <input type="file" name="image_profile" id="image_profile" value="{{ $staffValue->image_profile }}"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <a href="/admin-area/staff" class="btn btn-primary col-md-12 col-xs-12">Batal</a>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <button type="submit" class="btn btn-primary col-md-12 col-xs-12">Update</button>    
                    </div>
                </div>        
            </div>
        </form>            
        @else
        <form class="form-horizontal form-bordered" action="/admin-area/edit/staff-update/{{ $staffValue->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row col-md-12">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="username">Username</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="username" placeholder="Masukan Username" id="username" value="{{ $staffValue->username }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="name">Nama Lengkap</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" placeholder="Masukan Nama Lengkap" id="name" value="{{ $staffValue->name }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="phone">No Handphone</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="phone" placeholder="Masukan No Handphone" id="phone" value="{{ $staffValue->phone }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="phone">Email</label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email" id="email" value="{{ $staffValue->email }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="address">Alamat</label>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control" name="address" placeholder="Masukan Alamat" id="address" required>{{ $staffValue->address }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Foto Profile Staff</label>
                    <div class="col-md-10">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-append">
                                <img src="{{ asset('storage/images/profile/'.$staffValue->image_profile) }}" alt="image_profile" width="100px" height="150px" style="margin-bottom: 5px;">
                                <div class="uneditable-input">
                                    <span class="fileupload-preview"></span>
                                </div>
                                <span class="btn btn-default btn-file">
                                    <input type="file" name="image_profile" id="image_profile" value="{{ $staffValue->image_profile }}"/>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-6 col-xs-6">
                        <a href="/admin-area/staff" class="btn btn-primary col-md-12 col-xs-12">Batal</a>
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