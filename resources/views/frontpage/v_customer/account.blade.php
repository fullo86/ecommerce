@extends('frontpage/layouts/main')
@section('title', 'Akun Saya')
@section('customerAccount')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div class="container-fluid">
    <h2 class="bg-secondary pr-3 text-center mb-5">Akun Saya</h2>
    <div class="row px-xl-5">
        <form action="/customer/account/update/{{ auth()->guard('customer')->user()->id }}" method="post" class="form-row" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="col-lg-4">
                <div class="bg-light p-30 mb-5">
                  <div class="border-bottom">
                    <div class="d-flex justify-content-between">
                        <img src="{{ asset('storage/images/profile/'.auth()->guard('customer')->user()->image_profile) }}" alt="{{ auth()->guard('customer')->user()->username }}" style="max-width: 350px; max-height: 350px;">
                    </div>
                      <label class="mt-2">Ganti Profil</label>
                      <input
                        class="form-control"
                        type="file"
                        name="image_profile"
                        value="{{ auth()->guard('customer')->user()->image_profile }}"
                      />
                  </div>
                </div>
              </div>    
          <div class="col-lg-8">
            <div class="bg-light p-30 mb-5">
              <div class="row">
                <div class="col-md-12 form-group">
                  <label>Nama</label>
                  <input class="form-control" type="text" name="name" value="{{ auth()->guard('customer')->user()->name }}" placeholder="Masukan Nama" required/>
                </div>
                <div class="col-md-12 form-group">
                  <label>No Hp</label>
                  <input class="form-control" type="text" value="{{ auth()->guard('customer')->user()->phone }}" placeholder="Masukan No Handphone" />
                </div>
                <div class="col-md-12 form-group">
                  <label>E-mail</label>
                  <input
                    class="form-control"
                    type="email"
                    value="{{ auth()->guard('customer')->user()->email }}"
                    placeholder="Masukan Email"
                  />
                </div>
                <div class="col-md-12 form-group">
                  <label>Alamat</label>
                  <textarea
                    class="form-control"
                    type="text"
                    placeholder="Masukan Alamat"
                  >
                  {{ auth()->guard('customer')->user()->address }}
                  </textarea>
                </div>
                <div class="col-md-6 form-group">
                  <label>Provinsi</label>
                  <select class="custom-select" name="province_id" id="provinceSelect">
                    <option value="{{auth()->guard('customer')->user()->province_id}}" selected>Pilih Provinsi</option>
                    @foreach ($dataApi1 as $row)
                      <option value="{{ $row['province_id'] }}">{{ $row['province'] }}</option>                        
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <label>Kota</label>
                  <select class="custom-select" name="city_id" id="citySelect">
                    <option value="{{auth()->guard('customer')->user()->city_id}}" selected>Pilih Kota</option>                        
                    @foreach ($dataApi2 as $row)
                    <option value="{{ $row['city_id'] }}" data-zip-code="{{ $row['postal_code'] }}">{{ $row['city_name'] }}</option>                        
                    @endforeach
                  </select>
                </div>
                <input type="hidden" name="zip_code" id="zipCode" class="zipCode" value="">
                <button class="btn btn-block btn-primary font-weight-bold py-3 mt-3">
                    Perbarui Akun
                </button>            
              </div>
            </div>
          </div>
        </form>    
    </div>
  </div>
<script>
    $(document).ready(function() {
        $('#citySelect').on('change', function() {
            var selectedZipCode = $(this).find(':selected').data('zip-code');
            $('.zipCode').val(selectedZipCode);
        });
    });
</script>
@endsection
