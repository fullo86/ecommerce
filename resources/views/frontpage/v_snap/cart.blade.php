@extends('frontpage/layouts/main')
@section('title', 'Keranjang Belanja')
@section('cartPage')
<h2 class="text-center mb-5">Keranjang Belanja</h2>
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            @if(Cart::count() > 0)
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach(Cart::content() as $item)
                    {{-- {{$item->rowId}} --}}
                        <tr>
                            <td class="align-middle">
                                {{ $item->name }}
                            </td>
                            <td class="align-middle">
                                {{ $item->options['size']['name'] }}
                            </td>
                            <td class="align-middle no-wrap">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary update-cart btn-minus" data-id="{{ $item->rowId }}"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $item->qty }}" id="qty_{{ $item->rowId }}">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary update-cart btn-plus" data-id="{{ $item->rowId }}"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle price_" id="price_">Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            <td class="align-middle">
                                <form action="/customer/cart/remove/{{ $item->rowId }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <img class="mx-auto d-block" src="http://127.0.0.1:8000/images-static/cart-empty.jpg" alt="Empty Cart" width="350px">
                <h4 class="text-center">Ups Keranjang Masih Kosong</h4>
            @endif
        </div>
        <div class="col-lg-4">
            <form class="mb-30" action="#">
                <div class="input-group">
                    <input type="text" class="form-control border-0 p-4" placeholder="Kode Kupon">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Terapkan</button>
                    </div>
                </div>
            </form>
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Ringkasan Keranjang</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    {{-- {{Cart::content()-<}} --}}
                    @php
                        $total = 0;
                    @endphp                    
                    @foreach (Cart::content() as $item)
                    <div class="d-flex justify-content-between mb-3">
                        <h6 style="max-width: 250px">{{ $item->name }}</h6>
                        <h6 class="price_">Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</h6>
                    </div>
                    @php
                        $total += $item->subtotal;
                    @endphp
                    @endforeach
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>Rp. {{ number_format($total, 0, ',', '.') }}</h5>
                    </div>
                    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" onclick="window.location.href='/customer/checkout'">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function () {
    $('.update-cart').on('click', function (e) {
        e.preventDefault();

        let rowId = $(this).data('id');
        console.log('ini row' + rowId);
        let qty = $('#qty_' + rowId).val();
        let price = $('.price_' + rowId).text().replace(/[^\d]/g, '');

        $.ajax({
            url: '/customer/cart/update/' + rowId,
            method: 'patch',
            data: {
                '_token': '{{ csrf_token() }}',
                'qty': qty,
                'price': price
            },
            success: function (response) {
                console.log(response);
                $('.price_' + rowId).text('Rp. ' + response.new_price);
                location.reload();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
</script>
@endsection
