@extends('frontpage/layouts/main')
@section('title', 'Ganti Password')

@section('customerChangePasswordAccount')
<div class="container-fluid">
    <h2 class="bg-secondary pr-3 text-center mb-5">Ganti Password</h2>
    <div class="row px-xl-5 justify-content-center">
        <form action="/customer/account/change-password/update/{{ auth()->guard('customer')->user()->id }}" method="post" class="form-row" enctype="multipart/form-data">
            @csrf
            @method('patch')
          <div class="col-lg-12">
            @if (Session::has('status'))
            <div class="alert {{ Session::get('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
                {{ Session::get('message') }}
            </div>
            @endif
            <div class="bg-light p-30 mb-5">
              <div class="row">
                <div class="col-md-12 form-group">
                  <label>Password Lama</label>
                  <input class="form-control" type="password" name="old_password" placeholder="Masukan Password Lama" required/>
                </div>
                <div class="col-md-12 form-group">
                  <label>Password Baru</label>
                  <input class="form-control" type="password" name="new_password" placeholder="Masukan Password Baru" required/>
                </div>
                <div class="col-md-12 form-group">
                  <label>Konfirmasi Password</label>
                  <input class="form-control" type="password" name="repeat_password" placeholder="Konfirmasi Password" required/>
                </div>
                <button class="btn btn-block btn-primary font-weight-bold py-3 mt-3">
                    Submit
                </button>            
              </div>
            </div>
          </div>
        </form>    
    </div>
  </div>
@endsection
