@extends('frontpage/layouts/main')
@section('title', 'Daftar')
@section('registerFrontPage')
<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5 justify-content-center">
      <div class="col-lg-6">
        <h5 class="section-title text-center mb-3">
          <span class="bg-secondary pr-3">Daftar</span>
        </h5>
        <div class="bg-light p-30 mb-5">
          <form action="/customer/register/save" method="post">
            @csrf
            @if (Session::has('status'))
              <div class="alert {{ Session::get('status') == 'success' ? 'alert-success' : 'alert-failed' }}">
                  {{ Session::get('message') }}
              </div>
            @endif
            <div class="row">
                <div class="col-md-12 form-group">
                  <label>Username</label>
                  <input class="form-control" type="text" name="username" placeholder="Masukan Username" required/>
                </div>
                <div class="col-md-12 form-group">
                  <label>Nama Lengkap</label>
                  <input class="form-control" type="text" name="name" placeholder="Masukan Nama" required/>
                </div>
                <div class="col-md-12 form-group">
                  <label>Password</label>
                  <input class="form-control" type="password" name="password" placeholder="Masukan Password" required/>
                </div>
                <div class="col-md-12 form-group">
                    <label>No Handphone</label>
                    <input class="form-control" type="text" name="phone" placeholder="Masukan No Handphone" required/>
                </div>  
                <div class="col-md-12 form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" placeholder="Masukan Email" required/>
                </div>  
                <button class="btn btn-block btn-primary font-weight-bold py-3 mt-3">
                    Daftar
                </button>
            </div>  
          </form>
         <div class="mt-4 text-center">
            Sudah Punya Akun?<a href="/customer/login"> Login</a>
        </div>
        </div>
      </div>
    </div>
  </div>
<!-- Checkout End -->    
@endsection