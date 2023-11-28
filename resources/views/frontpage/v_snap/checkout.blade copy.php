@extends('frontpage/layouts/main')
@section('title', 'Checkout')
@section('checkoutPage')
<style>
    .hidden {
    display: none !important;
}
</style>
    <!-- Checkout Start -->
    <div class="container-fluid">
      <div class="row px-xl-5">
        <div class="col-lg-8">
          <h5 class="section-title position-relative text-uppercase mb-3">
            <span class="bg-secondary pr-3">Alamat Pengiriman</span>
          </h5>
          <div class="bg-light p-30 mb-5">
            <div class="row">
              <div class="col-md-6 form-group ori-ship">
                <label>Kepada: </label> {{auth()->guard('customer')->user()->name}}<br>
                <label>Alamat: </label> {{auth()->guard('customer')->user()->address}}<br>
                <label>Kota: </label> Kota Tegal<br>
                <label>Provinsi: </label> Jawa Tengah<br>
              </div>
              <div class="col-md-12">
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
        {{-- @dd($dataShipping) --}}
        <div class="col-lg-4">
          <h5 class="section-title position-relative text-uppercase mb-3">
            <span class="bg-secondary pr-3">Total Order</span>
          </h5>
          <div class="bg-light p-30 mb-5">
            {{-- <form action="/customer/checkout" method="post">
              @csrf
              <input type="hidden" name="customer_id" value="{{auth()->guard('customer')->user()->id}}">
              <input type="hidden" name="phone" value="{{auth()->guard('customer')->user()->phone}}">
              <input type="hidden" name="address" value="{{auth()->guard('customer')->user()->address}}"> --}}
            <div class="border-bottom">
              <h6 class="mb-3">Rincian Belanja</h6>
              @php
                  $total = 0;
              @endphp
              @foreach (Cart::content() as $item)
              <div class="d-flex justify-content-between">
                <p style="max-width: 250px">{{ $item->name }}</p>
                <input type="hidden" name="products[]" value="{{ $item->id }}">
                <p>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</p>
              </div>
              @php
                  $total += $item->subtotal;
                  $grandTotal = $total + $dataShipping[0]['cost'][0]['value'];
              @endphp
              @endforeach
            </div>
            <div class="border-bottom pt-3 pb-2">
              <div class="d-flex justify-content-between mb-3">
                <h6>Subtotal</h6>
                <h6>Rp. {{ number_format($total, 0, ',', '.') }}</h6>
              </div>
              <div class="d-flex justify-content-between">
                <h6 class="font-weight-medium">Pengiriman</h6>
                <h6 class="font-weight-medium">Rp. {{ number_format($dataShipping[0]['cost'][0]['value'], 0, ',', '.') }}</h6>
              </div>
            </div>
            <p class="text-italic">Pengiriman menggunakan kurir JNE</p>
            <div class="pt-2">
              <div class="d-flex justify-content-between mt-2">
                <h5>Total</h5>
                <h5>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</h5>
                <input type="hidden" name="total_price" value="{{ $grandTotal }}">
              </div>
            </div>
            <button class="btn btn-block btn-primary font-weight-bold py-3 mt-3" id="pay-button">
                Bayar Sekarang
            </button>            
          {{-- </form> --}}
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
<script type="text/javascript">
  // For example trigger on button clicked, or any time you need
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
    // Also, use the embedId that you defined in the div above, here.
    window.snap.embed(`$snapToken`, {
      embedId: 'snap-container',
      onSuccess: function (result) {
        /* You may add your own implementation here */
        alert("payment success!"); console.log(result);
      },
      onPending: function (result) {
        /* You may add your own implementation here */
        alert("wating your payment!"); console.log(result);
      },
      onError: function (result) {
        /* You may add your own implementation here */
        alert("payment failed!"); console.log(result);
      },
      onClose: function () {
        /* You may add your own implementation here */
        alert('you closed the popup without finishing the payment');
      }
    });
  });
</script>
@endsection
