@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Invoice')
    
@section('invoiceAdminArea')
<section role="main" class="content-body">
<section class="panel" style="background-color: #777777">
    <div class="panel-body">
        <div class="invoice">
            <header class="clearfix">
                <div class="row">
                    <div class="col-sm-6 mt-md">
                        <h2 class="h2 mt-none mb-sm text-dark text-bold">INVOICE</h2>
                        <h4 class="h4 m-none text-dark text-bold">#{{ $data[0]->order_id }}</h4>
                    </div>
                    <div class="col-sm-6 text-right mt-md mb-md">
                        <address class="ib mr-xlg">
                            Minsu ID
                            <br>
                            Jl. Gambesi, Ternate Selatan
                            <br>
                            Phone: +12 3 4567-8901
                            <br>
                            cs@minsu.id
                        </address>
                        <div class="ib">
                            <img src="/images-static/image-inv.jpg" alt="OKLER Themes">
                        </div>
                    </div>
                </div>
            </header>
            <div class="bill-info">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bill-to">
                            <p class="h5 mb-xs text-dark text-semibold">To:</p>
                            <address>
                                @if ($data[0]->recipient_name == null)
                                    {{ $data[0]->customer->name }}                                    
                                @else
                                    {{ $data[0]->recipient_name }}
                                @endif
                                <br>
                                    @foreach ($cities as $city)
                                        @if ($data[0]->city_id == $city['city_id'])
                                            {{ $data[0]->address.', '.$city['city_name'].', '.$city['province'] }}
                                        @endif
                                    @endforeach
                                <br>
                                    {{ $data[0]->phone }}
                                <br>
                                    {{ $data[0]->email }}
                            </address>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bill-data text-right">
                            <p class="mb-none">
                                <span class="text-dark">Invoice Date:</span>
                                <span class="value">{{ \Carbon\Carbon::now()->format('d/m/y') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="table-responsive">
                <table class="table invoice-items">
                    <thead>
                        <tr class="h4 text-dark">
                            <th id="cell-id" class="text-semibold">No</th>
                            <th id="cell-item" class="text-semibold">Produk</th>
                            <th id="cell-price" class="text-center text-semibold">Ukuran</th>
                            <th id="cell-price" class="text-center text-semibold">Harga</th>
                            <th id="cell-qty" class="text-center text-semibold">Quantity</th>
                            <th id="cell-total" class="text-center text-semibold">Total</th>
                        </tr>
                    </thead>
                    @php
                        $no = 1;
                        $shippingCost = 0;
                        $subTotal = 0;
                    @endphp
                    <tbody>
                        @foreach ($data[0]->products as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="text-semibold text-dark">{{ $item->product_name }}</td>
                                <td class="text-center">{{ $item->pivot->size }}</td>
                                <td class="text-center">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $item->pivot->qty }} pcs</td>
                                <td class="text-center">Rp. {{ number_format($item->price * $item->pivot->qty, 0, ',', '.') }}</td>
                            </tr>
                            @php
                                $subTotal += $item->price * $item->pivot->qty;
                                $shippingCost = $item->pivot->ship_cost;                        
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        
            <div class="invoice-summary">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table h5 text-dark">
                            <tbody>
                                <tr class="b-top-none">
                                    <td colspan="2">Subtotal</td>
                                    <td class="text-left">Rp. {{ number_format($subTotal, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Pengiriman</td>
                                    <td class="text-left">Rp. {{ number_format($shippingCost, 0, ',', '.') }}</td>
                                </tr>
                                <tr class="h4">
                                    <td colspan="2">Total Bayar</td>
                                    <td class="text-left">Rp.{{ number_format($subTotal + $shippingCost, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mr-lg">
            <a href="javascript:void(0);" target="_blank" id="print-button" class="btn btn-primary ml-sm"><i class="fa fa-print"></i> Print</a>
        </div>
    </div>
</section>
</section>
<script>
    // Menambahkan event listener ke tombol print
    document.getElementById('print-button').addEventListener('click', function () {
        // Membuka tab baru
        var newTab = window.open('', '_blank');

        // Menunggu sebentar sebelum memasukkan HTML ke tab baru
        setTimeout(function () {
            // Mengisi HTML dari elemen dengan ID invoiceAdminArea ke tab baru
            newTab.document.write('<html><head><title>Invoice</title></head><body>');
            newTab.document.write(document.getElementById('invoiceAdminArea').innerHTML);
            newTab.document.write('</body></html>');

            // Menunggu sebentar sebelum memicu pencetakan
            setTimeout(function () {
                // Memicu pencetakan di tab baru
                newTab.print();
            }, 1000); // Sesuaikan waktu menunggu sesuai kebutuhan
        }, 1000); // Sesuaikan waktu menunggu sesuai kebutuhan
    });
</script>
@endsection
