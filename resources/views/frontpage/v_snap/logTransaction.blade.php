@extends('frontpage/layouts/main')
@section('title', 'Riwayat Transaksi')
@section('historyTrasactionPage')
    <!-- Checkout Start -->
    <div class="container-fluid">
    <h2 class="text-center mb-5">Riwayat Transaksi</h2>
      <div class="row px-xl-5">
        <div class="col-lg-8">
          <h5 class="section-title position-relative text-uppercase mb-3">
            <span class="bg-secondary pr-3">Riwayat Transaksi</span>
          </h5>
          <div class="bg-light p-30 mb-5">
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Order ID</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Total Pembayaran</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $row)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            @if ($row->recipient_name == null)
                                <td>{{ auth()->guard('customer')->user()->name }}</td>
                            @else
                            <td>{{ $row->recipient_name }}</td>
                            @endif
                            <td>{{ $row->order_id }}</td>
                            <td>Rp. {{ number_format($row->total_price, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->detailTrx->transaction_time)->format('d-m-Y') }}</td>
                            <td>{{ $row->detailTrx->transaction_status == 'settlement' ? 'Berhasil' : $row->detailTrx->transaction_status }}</td>
                            <td class="align-items-center">
                              <a href="#" data-toggle="collapse" data-target="#shipping-address">Detail</a>
                            </td>
                          </tr>
                        <tr>                                
                        @endforeach
                    </tbody>
                  </table>              
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <h5 class="section-title position-relative text-uppercase mb-3">
            <span class="bg-secondary pr-3">Produk</span>
          </h5>
          <div class="bg-light p-30 mb-5 collapse" id="shipping-address">
            <div class="border-bottom">
              @foreach ($history as $row)
                  @foreach ($row->products as $item)
                  <div class="d-flex justify-content-between">
                    <p>{{$item->product_name}}</p><br>
                  </div>
                  @endforeach
              @endforeach
            </div>
            {{-- <div class="border-bottom pt-3 pb-2">
              <div class="d-flex justify-content-between mb-3">
                <h6>Subtotal</h6>
                <h6>$150</h6>
              </div>
              <div class="d-flex justify-content-between">
                <h6 class="font-weight-medium">Shipping</h6>
                <h6 class="font-weight-medium">$10</h6>
              </div>
            </div> --}}
            {{-- <div class="pt-2">
              <div class="d-flex justify-content-between mt-2">
                <h5>Total</h5>
                <h5>$160</h5>
              </div>
            </div> --}}
            {{-- <div class="custom-control custom-checkbox justify-content-center"> --}}
            {{-- </div> --}}
          </div>
        </div>
      </div>
    </div>
    <!-- Checkout End -->
@endsection
