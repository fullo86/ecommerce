@extends('frontpage/layouts/main')
@section('title', 'Riwayat Transaksi')
@section('trasactionPage')
<style>
  #snap-container {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1;
}
</style>
<div class="container-fluid">
  <div class="row px-xl-5">
    <div class="col-lg-8">
      <h5 class="section-title position-relative text-uppercase mb-3">
        <span class="bg-secondary pr-3">Alamat Pengiriman</span>
      </h5>
      <div class="bg-light p-30 mb-5">
        <div class="row">
          <div class="col-md-6 form-group">
            @if (auth()->guard('customer')->user()->id == $dataTrx->customer_id)
              <label>Kepada: </label> {{auth()->guard('customer')->user()->name}}<br>                
            @else
              <label>Kepada: </label> {{$dataTrx->recipient_name}}<br>
            @endif
            @if (auth()->guard('customer')->user()->id == $dataTrx->customer_id)
              <label>Alamat: </label> {{auth()->guard('customer')->user()->address}}<br>
            @else
              <label>Alamat: </label> {{$dataTrx->address}}<br>
            @endif
            @foreach ($state as $row)
              @if (auth()->guard('customer')->user()->city_id == $row['city_id'])
                <label>Kota: </label> {{$row['city_name']}}<br>
              @endif
            @endforeach
            @php
              $displayedProvinceIds = [];
            @endphp
            @foreach ($state as $row)
              @if (auth()->guard('customer')->user()->province_id == $row['province_id'] && !in_array($row['province_id'], $displayedProvinceIds))
                <label>Provinsi: </label> {{$row['province']}}<br>
                @php
                  $displayedProvinceIds[] = $row['province_id'];
                @endphp
              @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <h5 class="section-title position-relative text-uppercase mb-3">
        <span class="bg-secondary pr-3">Total Order</span>
      </h5>
      <div class="bg-light p-30 mb-5">
        <div class="border-bottom">
          <h6 class="mb-3">Rincian Belanja</h6>
          @php
              $total = 0;
          @endphp
          @foreach (Cart::content() as $item)
          <div class="d-flex justify-content-between">
            <p style="max-width: 250px">{{ $item->name }}</p>
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
          </div>
        </div>
        <button class="btn btn-block btn-primary font-weight-bold py-3 mt-3" id="pay-button">
            Bayar Sekarang
        </button>
      </div>
    </div>
    <div class="center-pop" id="snap-container">
    </div>    
</div>
</div>
<!-- Checkout End -->
<script type="text/javascript">
  // For example trigger on button clicked, or any time you need
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function () {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
    // Also, use the embedId that you defined in the div above, here.
    window.snap.embed('{{$snapToken}}', {
      embedId: 'snap-container',
      onSuccess: function (result) {
        /* You may add your own implementation here */
        clearCart();
        window.location.href = '/customer/transaction/history'; // Ganti dengan rute yang sesuai
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

  function clearCart() {
        // AJAX request untuk menghapus data keranjang
        fetch('/customer/cart/clear', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({}),
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
    }  
</script>
@endsection
