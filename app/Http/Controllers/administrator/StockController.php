<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    public function index()
    {
        $stockProduct = Product::all();
        return view('adminarea/v_stock/stock', ['stocks' => $stockProduct]);
    }

    public function edit($id)
    {
        $stockProductValue = Product::findOrFail($id);
        return view('adminarea/v_stock/editStock', ['stockValue' => $stockProductValue]);
    }

    public function update(Request $request, $id)
    {
        $productStock = Product::findOrFail($id);
        $newStock = $request->input('stock');

        if ($productStock) {
            $productStock->stock = $newStock;

        if ($newStock > 0) {
            $productStock->status_stock = 'in stock';
        } else {
            $productStock->status_stock = 'out of stock';
        }

            $productStock->save();
            Session::flash('status', 'success');
            Session::flash('message', 'Stok Produk Berhasil Diupdate');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Stok Produk Gagal Diupdate');
        }

        return redirect('/admin-area/stocks');
    }
}
