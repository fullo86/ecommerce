@extends('frontpage/layouts/main')
@section('title', 'Checkout')
@section('checkoutAddressPage')
<style>
    .hidden {
    display: none !important;
}
</style>
    <!-- Checkout Start -->
    <div class="container-fluid">
      <div class="row px-xl-5">
        <div class="col-lg-12">
          <h5 class="section-title position-relative text-uppercase mb-3">
            <span class="bg-secondary pr-3">Alamat Pengiriman</span>
          </h5>
          <div class="bg-light p-30 mb-5">
            <form action="/customer/checkout" method="post">
              @csrf            
            <div class="row ori-ship">
              @php
                $total = 0;
              @endphp
              @foreach (Cart::content() as $item)
              <input type="hidden" name="products[]" value="{{ $item->id }}">
              {{-- <input type="hidden" name="products[]" value="{{ $item->qty }}"> --}}
              @php
                  $total += $item->subtotal;
                  $grandTotal = $total + $dataShipping[0]['cost'][0]['value'];
              @endphp
              @endforeach
              <input type="hidden" name="total_price" value="{{ $grandTotal }}">
              <input type="hidden" name="qty" value="{{ $item->qty }}">
              <div class="col-md-6 form-group">
                <label>Nama Penerima</label>
                <input class="form-control" type="text" placeholder="Masukan Nama" value="{{auth()->guard('customer')->user()->name}}" readonly/>
                <input type="hidden" name="customer_id" value="{{auth()->guard('customer')->user()->id}}">
              </div>
              <div class="col-md-6 form-group">
                <label>No Handphone</label>
                <input class="form-control" type="text" name="phone" placeholder="Masukan No Handphone" value="{{auth()->guard('customer')->user()->phone}}" readonly/>
              </div>
              <div class="col-md-6 form-group">
                <label>E-mail</label>
                <input
                  class="form-control"
                  type="email"
                  name="email"
                  placeholder="example@email.com"
                  value="{{auth()->guard('customer')->user()->email}}"
                  readonly
                  />
              </div>
              <div class="col-md-6 form-group">
                <label>Alamat</label>
                <textarea
                  class="form-control"
                  type="text"
                  name="address"
                  placeholder="+123 456 789"
                  readonly
                >{{auth()->guard('customer')->user()->address}}</textarea>
              </div>
              <div class="col-md-6 form-group">
                <label>Kota</label>
                <select class="custom-select" name="city_id" id="citySelect">
                  @foreach ($city as $row)
                    @if (auth()->guard('customer')->user()->city_id == $row['city_id'])
                      <option value="{{ $row['city_id'] }}" data-zip-code="{{ $row['postal_code'] }}">{{ $row['city_name'] }}</option>                      
                    @endif
                  @endforeach
                </select>
              </div>
            <div class="col-md-6 form-group">
              <label>Kode Pos</label>
                <input class="form-control" type="text" name="zip_code" placeholder="Masukan Negara" value="{{auth()->guard('customer')->user()->zip_code}}" readonly/>
              </div>
              <button class="btn btn-block btn-primary font-weight-bold py-3 mt-3">
                Berikutnya
              </button>            
            </div>
          </form>
          <div class="col-md-12 mt-3">
              <div class="custom-control custom-checkbox">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="shipto"
                />
                <label
                  class="custom-control-label"
                  for="shipto"
                  data-toggle="collapse"
                  data-target="#shipping-address"
                  >Kirim ke Alamat Lain</label
                >
              </div>
            </div>
          </div>
          <div class="collapse mb-5" id="shipping-address">
            <h5 class="section-title position-relative text-uppercase mb-3">
              <span class="bg-secondary pr-3">Shipping Address</span>
            </h5>
            <div class="bg-light p-30">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>First Name</label>
                  <input class="form-control" type="text" placeholder="John" />
                </div>
                <div class="col-md-6 form-group">
                  <label>Last Name</label>
                  <input class="form-control" type="text" placeholder="Doe" />
                </div>
                <div class="col-md-6 form-group">
                  <label>E-mail</label>
                  <input
                    class="form-control"
                    type="text"
                    placeholder="example@email.com"
                  />
                </div>
                <div class="col-md-6 form-group">
                  <label>Mobile No</label>
                  <input
                    class="form-control"
                    type="text"
                    placeholder="+123 456 789"
                  />
                </div>
                <div class="col-md-6 form-group">
                  <label>Address Line 1</label>
                  <input
                    class="form-control"
                    type="text"
                    placeholder="123 Street"
                  />
                </div>
                <div class="col-md-6 form-group">
                  <label>Address Line 2</label>
                  <input
                    class="form-control"
                    type="text"
                    placeholder="123 Street"
                  />
                </div>
                <div class="col-md-6 form-group">
                  <label>Country</label>
                  <select class="custom-select">
                    <option selected>United States</option>
                    <option>Afghanistan</option>
                    <option>Albania</option>
                    <option>Algeria</option>
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <label>City</label>
                  <input
                    class="form-control"
                    type="text"
                    placeholder="New York"
                  />
                </div>
                <div class="col-md-6 form-group">
                  <label>State</label>
                  <input
                    class="form-control"
                    type="text"
                    placeholder="New York"
                  />
                </div>
                <div class="col-md-6 form-group">
                  <label>ZIP Code</label>
                  <input class="form-control" type="text" placeholder="123" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Checkout End -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var checkbox = document.getElementById('shipto');
        var oriShipDiv = document.querySelector('.ori-ship');

        checkbox.addEventListener('change', function () {
            if (checkbox.checked) {
                // Checkbox di-check, sembunyikan elemen dengan kelas ori-ship
                oriShipDiv.classList.add('hidden');
            } else {
                // Checkbox tidak di-check, tampilkan kembali elemen dengan kelas ori-ship
                oriShipDiv.classList.remove('hidden');
            }
        });
    });
</script>    
{{-- <script>
  $(document).ready(function() {
    $('#checkoutForm').on('submit', function(e) {
      e.preventDefault(); // Mencegah formulir dikirim secara default

      // Handle pengiriman formulir menggunakan AJAX atau metode lainnya jika diperlukan

      // Setelah formulir berhasil dikirim, lakukan pengalihan
      window.location.href = '/'; // Ganti dengan rute yang sesuai
    });
  });
</script> --}}
@endsection
