@extends('frontpage/layouts/main')
@section('title', 'Reset Password')
@section('resetPasswordFrontPage')
<div class="container-fluid">
    <div class="row px-xl-5 justify-content-center">
      <div class="col-lg-5">
        <h5 class="section-title text-center mb-3 mb-5">
          <span class="bg-secondary pr-3">Reset Password</span>
        </h5>
        <div class="bg-light p-30 mb-5">
          <form action="{{ route('password.update') }}" method="post">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('status'))
              <div class="text-center alert {{ Session::get('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
                    {{ Session::get('message') }}
                </div>
            @endif
            <input type="hidden" name="token" value="{{ request()->token }}">
            <input type="hidden" name="email" value="{{ request()->email }}">
            <div class="row">
              <div class="col-md-12 form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" placeholder="Masukan Password" required/>
              </div>
              <div class="col-md-12 form-group">
                <label>Konfirmasi Password</label>
                <input class="form-control" type="password" name="password_confirmation" placeholder="Konfirmasi Password" required/>
              </div>
              <button class="btn btn-block btn-primary font-weight-bold py-3 mt-2">
                  Submit
              </button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection