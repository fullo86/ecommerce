<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\DetailTrx;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction =  Transaction::with('customer')->get();

        $dataProvince = Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->get('https://api.rajaongkir.com/starter/province');
        $responseProv = $dataProvince->json()['rajaongkir']['results'];

        $dataCity = Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->get('https://api.rajaongkir.com/starter/city');
        $responseCity = $dataCity->json()['rajaongkir']['results'];

        return view('adminarea/v_transaction/transaction', ['listTransaction' => $transaction, 'prov' => $responseProv, 'cities' => $responseCity]);
    }

    public function detailTrx($order)
    {
        $trx = DetailTrx::with('transaction')->findOrFail($order);
        return view('adminarea/v_transaction/transaction_detail', ['trxDetails' => $trx]);
    }

    public function invoice($id)
    {
        $trx = Transaction::with('products')->where('order_id', $id)->get();
        return view('adminarea/v_transaction/invoice', ['data' => $trx]);
    }
}
