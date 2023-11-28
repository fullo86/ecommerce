<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\DetailTrx;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SnapController extends Controller
{
    public function cart()
    {
        $categories = Category::select('id', 'category_name')->get();
        return view('frontpage/v_snap/cart', ['listCategories' => $categories]);
    }

    public function addToCart(Request $request, $id)
    {
        $idProduct      = $id;
        $request->input('price');
        $selectedSize = $request->input('selectedSize');
        $qty            = "1";

        $product = Product::with('sizes')->findOrFail($idProduct);
        $selectedSizeData = $product->sizes->where('id', $selectedSize)->first();
        Cart::add([
            'id'    => $product->id,
            'qty'   => $qty,
            'price' => $product->price,
            'name'  => $product->product_name,
            'options' => ['image' => $product->image_product1 ,
            'weight' => $product->weight,
            'size'   => [
                'id'   => $selectedSizeData->id,
                'name' => $selectedSizeData->size_name,
                ],
            ],
        ]);

        return redirect('/customer/cart');
    }    

    public function updateCart(Request $request, $id)
    {
        $cartItems = Cart::content();    
        $item = $cartItems->where('rowId', $id)->first();
        if ($item) {
            $rowId = $item->rowId;    
            $qty = $request->input('qty');
            $priceProduct = $request->input('price');
    
            $dataUpdate = Cart::update($rowId, $qty, $priceProduct);
    
            return response()->json(['success' => true, 'data' => $dataUpdate]);
        } else {
            return response()->json(['success' => false, 'message' => 'Item not found in the cart.']);
        }
    }
        

    public function removeCart($id)
    {
        Cart::remove($id);

        return redirect('/customer/cart');
    }

    public function checkout()
    {
        $categories = Category::select('id', 'category_name')->get();
        $productWeight = Cart::content();
        $totalWeight = 0;
        $filteredData = [];
        
        foreach ($productWeight as $item) {
            $totalWeight += $item->options->weight * $item->qty;
        }

        $dataCities = Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->get('https://api.rajaongkir.com/starter/city');
        $responseCity = $dataCities->json()['rajaongkir']['results'];

        $shippingCost =  Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->post('https://api.rajaongkir.com/starter/cost',  [
            'origin' => 477,
            'destination' => auth()->guard('customer')->user()->city_id,
            'weight' => $totalWeight,
            'courier' => 'jne',
        ]);
        $response = $shippingCost->json()['rajaongkir']['results'][0]['costs'];

        foreach ($response as $item) {
            if ($item["service"] === "REG" || $item["service"] === "CTC") {
                $filteredData[] = $item;
            }
        }
        
        return view('frontpage/v_snap/checkoutAddress', ['listCategories' => $categories, 'dataShipping' => $filteredData, 'city' => $responseCity]);
    }

    public function transaction(Request $request)
    {
        $categories = Category::select('id', 'category_name')->get();
        $productWeight = Cart::content();
        $totalWeight = 0;
        $filteredData = [];

        foreach ($productWeight as $item) {
            $totalWeight += $item->options->weight * $item->qty;
        }
        $shippingCost =  Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->post('https://api.rajaongkir.com/starter/cost',  [
            'origin' => 477,
            'destination' => auth()->guard('customer')->user()->city_id,
            'weight' => $totalWeight,
            'courier' => 'jne',
        ]);
        $response = $shippingCost->json()['rajaongkir']['results'][0]['costs'];
        foreach ($response as $item) {
            if ($item["service"] === "REG" || $item["service"] === "CTC") {
                $filteredData[] = $item;
            }
        }

        $id = Str::uuid();
        $data = $request->all();
        $data['id'] = $id->toString();
        $data['order_id'] = rand();
        $newTrx = Transaction::create($data);
        $newTrx->products()->sync($data['products']);
        return redirect('/customer/transaction')->with(['dataShipping' => $filteredData, 'listCategories' => $categories]);
    }

    public function confirmTrx(Request $request)
    {
        $categories = Category::select('id', 'category_name')->get();
        $dataTrx = Transaction::all();
        $dataCities = Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->get('https://api.rajaongkir.com/starter/city');
        $responseCity = $dataCities->json()['rajaongkir']['results'];

        $productWeight = Cart::content();
        $totalWeight = 0;
        $filteredData = [];
        
        foreach ($productWeight as $item) {
            $totalWeight += $item->options->weight * $item->qty;
        }
        $shippingCost =  Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->post('https://api.rajaongkir.com/starter/cost',  [
            'origin' => 477,
            'destination' => auth()->guard('customer')->user()->city_id,
            'weight' => $totalWeight,
            'courier' => 'jne',
        ]);
        $response = $shippingCost->json()['rajaongkir']['results'][0]['costs'];
        foreach ($response as $item) {
            if ($item["service"] === "REG" || $item["service"] === "CTC") {
                $filteredData[] = $item;
            }
        }
        $request['order_id'] = $dataTrx[0]->order_id;
        $data = $request->all();
        $newTrxDetail = DetailTrx::create($data);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id'        => $data['order_id'],
                'gross_amount'    => $dataTrx[0]->total_price,
            ),
            'customer_details'    => array(
                'customer'        => $dataTrx[0]->recipient_name == null ? auth()->guard('customer')->user()->name : $dataTrx[0]->recipient_name,
                'email'           => $dataTrx[0]->email,
                'phone'           => $dataTrx[0]->phone,
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // return view('frontpage/v_snap/checkoutAddress', ['snapToken' => $snapToken, 'newTrx' => $newTrx]);

        return view('frontpage/v_snap/transaction', ['dataShipping' => $filteredData, 'listCategories' => $categories, 'dataTrx' => $dataTrx[0], 'state' => $responseCity, 'snapToken' => $snapToken, 'transactionDetail' => $newTrxDetail]);
    }    

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'settlement') {
                $order = DetailTrx::find($request->order_id);
                    $order->update(['transaction_status' => $request->transaction_status, 
                    'status_code' => $request->status_code, 
                    'payment_type' => $request->payment_type, 
                    'transaction_time' => $request->transaction_time, 
                    'bank' => $request->va_numbers[0]['bank'], 
                    'va_number' => isset($request->va_numbers) ? $request->va_numbers[0]['va_number'] : (isset($request->permata_va_number) ? $request->permata_va_number : $request->bill_key),
                ]);
            }
        }
    }

    public function history()
    {
        $customer = auth()->guard('customer')->user();
        $categories = Category::select('id', 'category_name')->get();
        $trxHistory = Transaction::with(['products', 'detailTrx'])->where('customer_id', $customer->id)->get();
        return view('frontpage/v_snap/logTransaction', ['history' => $trxHistory, 'listCategories' => $categories,]);
    }

}












// public function transaction(Request $request)
    // {
    //     $id = Str::uuid();
    //     $data = $request->all();
    //     $data['id'] = $id->toString();
    //     $customerData = Customer::find($data['customer_id']);

    //     $newTrx = Transaction::create($data);
    //     $newTrx->products()->sync($data['products']);

    //     // Set your Merchant Server Key
    //     \Midtrans\Config::$serverKey = config('midtrans.server_key');
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = false;
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;
    //     $params = array(
    //         'transaction_details' => array(
    //             'order_id' => rand(),
    //             'gross_amount' => $data['total_price'],
    //         ),
    //         'customer_details' => array(
    //             'customer' => isset($data['recipient_name']) && $data['recipient_name'] ? $data['recipient_name'] : $customerData->name,
    //             'email' => isset($data['email']) && $data['email'] ? $data['email'] : $customerData->email,
    //             'phone' => $data['phone'],
    //         ),
    //     );
    //     $snapToken = \Midtrans\Snap::getSnapToken($params);
    //     // dd($snapToken);
    //     return view('frontpage/v_snap/checkoutAddress', ['snapToken' => $snapToken, 'newTrx' => $newTrx]);
    // }

        // public function callback(Request $request)
    // {
    //     $serverKey = config('midtrans.server_key');
    //     $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        
    //     // Log untuk debugging
    //     Log::info('Order ID: ' . $request->order_id);
    //     Log::info('Status Code: ' . $request->status_code);
    //     Log::info('Gross Amount: ' . $request->gross_amount);
    //     Log::info('Server Key: ' . $serverKey);
    //     Log::info('Calculated Hash: ' . $hashed);
    //     Log::info('Received Signature Key: ' . $request->signature_key);
    
    //     if ($hashed == $request->signature_key) {
    //         if ($request->transaction_status == 'capture') {
    //             $order = DetailTrx::find($request->order_id);
    
    //             // Log untuk debugging
    //             Log::info('Transaction Status: ' . $request->transaction_status);
                
    //             if ($order) {
    //                 $order->update(['transaction_status' => 'Di Bayar']);
                    
    //                 // Log untuk debugging
    //                 Log::info('Status Pembayaran Diperbarui ke "Di Bayar"');
    //             } else {
    //                 // Log untuk debugging
    //                 Log::error('Order dengan ID ' . $request->order_id . ' tidak ditemukan.');
    //             }
    //         } else {
    //             // Log untuk debugging
    //             Log::info('Transaction Status bukan "capture".');
    //         }
    //     } else {
    //         // Log untuk debugging
    //         Log::error('Hash tidak cocok. Verifikasi gagal.');
    //     }
    // }

    // public function updateCart(Request $request, $id)
    // {
    //     $qty = $request->input('qty');
    //     $product = Product::findOrFail($id);

    //     // Hitung harga total baru berdasarkan jumlah yang diperbarui
    //     $newTotal = $product->price * $qty;

    //     Cart::update($id, $qty, [
    //         'price' => $product->price,
    //         'options' => [
    //             'subtotal' => $newTotal, // Menyimpan harga total baru
    //         ],
    //     ]);

    //     return redirect();
    // }
        // $qty = $request->input('qty');

        // $product = Product::findOrFail($id);

        // // Hitung harga total baru berdasarkan jumlah yang diperbarui
        // $newTotal = $product->price * $qty;

        // Cart::update($id, $qty, [
        //     'price' => $product->price,
        //     'options' => [
        //         'subtotal' => $newTotal, // Menyimpan harga total baru
        //     ],
        // ]);

        // // Mengembalikan data yang diperbarui
        // $updatedCartItem = Cart::get($id);

        // return response()->json(['success' => 'Keranjang berhasil diperbarui', 'item' => $updatedCartItem]);

