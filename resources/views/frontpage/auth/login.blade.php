@extends('frontpage/layouts/main')
@section('title', 'Login Customer')
@section('loginFrontPage')
<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5 justify-content-center">
      <div class="col-lg-5">
        <h5 class="section-title text-center mb-3">
          <span class="bg-secondary pr-3">Login Customer</span>
        </h5>
        <div class="bg-light p-30 mb-5">
          <form action="/customer/login/auth" method="post">
            @csrf
            @if (Session::has('status'))
              <div class="text-center alert {{ Session::get('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="row">
              <div class="col-md-12 form-group">
                <label>Username</label>
                <input class="form-control" type="text" name="username" placeholder="Masukan Username" required/>
              </div>
              <div class="col-md-12 form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" placeholder="Masukan Password" required/>
              </div>
              <button class="btn btn-block btn-primary font-weight-bold py-3">
                  Masuk
              </button>
          </div>
          </form>
         <div class="mt-3 d-flex justify-content-between">
            <span>Belum Punya Akun?&nbsp;&nbsp;</span><a href="/customer/register"> Daftar</a>
            <a href="/forgot-password" class="ml-auto">Lupa Password</a>
        </div>
        </div>
      </div>
    </div>
  </div>
<!-- Checkout End -->    
@endsection