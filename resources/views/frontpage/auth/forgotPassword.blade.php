@extends('frontpage/layouts/main')
@section('title', 'Lupa Password')
@section('forgotPasswordFrontPage')
<div class="container-fluid">
    <div class="row px-xl-5 justify-content-center">
      <div class="col-lg-5">
        <h5 class="section-title text-center mb-3 mb-5">
          <span class="bg-secondary pr-3">Lupa Password</span>
        </h5>
        <div class="bg-light p-30 mb-5">
          <form action="{{ route('password.email') }}" method="post">
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
            <div class="row">
              <div class="col-md-12 form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" placeholder="Masukan Email" required/>
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