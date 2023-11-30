@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Detail Transaksi')
    
@section('transactionDetailAdminArea')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Detail Transaksi</h2>
    </header>

    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h1><strong>Order ID: {{ $trxDetails->order_id }}</strong></h1>
                </header>
                <div class="panel-body">
                    <h3>Total Pembayaran : Rp. {{ number_format($trxDetails->transaction->total_price, 0, ',', '.') }}</h3>
                    <h3>Metode Pembayaran : {{ ucwords(str_replace('_', ' ', strtolower($trxDetails->payment_type))) }}</h3>
                    @if ($trxDetails->payment_type == 'bank_transfer' || $trxDetails->payment_type == 'echannel')
                        <h3>Bank : {{ ucwords(str_replace('_', ' ', strtolower($trxDetails->bank))) }}</h3>
                        <h3>No Virtual Account : {{ ucwords(str_replace('_', ' ', strtolower($trxDetails->va_number))) }}</h3>
                    @endif
                    <h3>Tanggal Transaksi : {{ \Carbon\Carbon::parse($trxDetails->transaction_time)->format('H:i:s d-m-Y') }}</h3>
                    <h3>Status Pembayaran : {{ ucwords($trxDetails->transaction_status) }}</h3>
                </div>
            </section>
        </div>
<!-- end: page -->
  </section>
@endsection