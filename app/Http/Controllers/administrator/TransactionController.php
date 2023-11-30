<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\DetailTrx;
use App\Models\Size;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction =  Transaction::with('customer')->get();

        $dataCity = Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->get('https://api.rajaongkir.com/starter/city');
        $responseCity = $dataCity->json()['rajaongkir']['results'];

        return view('adminarea/v_transaction/transaction', ['listTransaction' => $transaction, 'cities' => $responseCity]);
    }

    public function detailTrx($order)
    {
        $trx = DetailTrx::with('transaction')->findOrFail($order);
        return view('adminarea/v_transaction/transaction_detail', ['trxDetails' => $trx]);
    }

    public function invoice($id)
    {
        $dataCity = Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->get('https://api.rajaongkir.com/starter/city');
        $responseCity = $dataCity->json()['rajaongkir']['results'];

        $trx   = Transaction::with(['products', 'customer'])->where('order_id', $id)->get();
        return view('adminarea/v_transaction/invoice', ['data' => $trx, 'cities' => $responseCity]);
    }

    public function destroy($id)
    {
        $removeTrx = Transaction::findOrFail($id);
        $removeTrx->delete();

        if (!$removeTrx) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Menghapus Data Transaksi');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menghapus Data Transaksi');
        return redirect('/admin-area/transaction');
    }

    public function showDeleted()
    {
        $deletedTrx = Transaction::onlyTrashed()->get();
        return view('adminarea/v_transaction/showDeleteTransaction', ['trxDeleted' => $deletedTrx]);
    }

    public function restore($id)
    {
        $restoreTrx = Transaction::withTrashed()->where('id', $id)->restore();

        if (!$restoreTrx) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Restore Data Transaksi');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Merestore Data Transaksi');
        return redirect('/admin-area/transaction');
    }
}
