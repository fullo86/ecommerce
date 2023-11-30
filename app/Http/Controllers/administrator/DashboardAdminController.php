<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $customer = Customer::count();
        $product  = Product::count();
        $trx      = Transaction::count();
        
        return view('adminarea/dashboard', ['totalCustomer' => $customer, 'totalProduct' => $product, 'totalTrx' => $trx]);
    }
}
