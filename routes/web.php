<?php

use App\Http\Controllers\administrator\CategoryController;
use App\Http\Controllers\administrator\CustomerController;
use App\Http\Controllers\administrator\DashboardAdminController;
use App\Http\Controllers\administrator\ProductController;
use App\Http\Controllers\administrator\StaffController;
use App\Http\Controllers\administrator\StockController;
use App\Http\Controllers\administrator\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SnapController;
use App\Http\Controllers\UserCustomerController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('not_login_user')->group(function() {
    Route::get('/auth/admin', [AuthController::class, 'viewLoginAdminArea'])->name('login');
    Route::post('/auth/admin', [AuthController::class, 'authenticateAdmin']);    
});

Route::middleware('auth')->group(function() {
    Route::get('/administrator/logout', [AuthController::class, 'logout']);

    Route::middleware('admin-or-staff')->group(function() {
        Route::get('/administrator/dashboard', [DashboardAdminController::class, 'index']);

        Route::get('/admin-area/customer', [CustomerController::class, 'index']);
        Route::get('/admin-area/edit/customer/{id}', [CustomerController::class, 'edit']);
        Route::put('/admin-area/edit/customer/update/{id}', [CustomerController::class, 'update']);
        Route::delete('/admin-area/delete/customer/{id}', [CustomerController::class, 'destroy']);
        
        Route::get('/admin-area/products', [ProductController::class, 'index']);
        Route::get('/admin-area/create/product', [ProductController::class, 'create']);
        Route::post('/admin-area/create/product/save', [ProductController::class, 'store']);
        Route::get('/admin-area/edit/product/{id}', [ProductController::class, 'edit']);
        Route::put('/admin-area/edit/product/update/{id}', [ProductController::class, 'update']);
        Route::patch('/admin-area/change-status/product/{id}', [ProductController::class, 'statusProduct']);
        Route::delete('/admin-area/delete/product/{id}', [ProductController::class, 'destroy']);
    
        Route::get('/admin-area/stocks', [StockController::class, 'index']);
        Route::get('/admin-area/edit/stock/{id}', [StockController::class, 'edit']);
        Route::patch('/admin-area/edit/stock/update/{id}', [StockController::class, 'update']);

        Route::get('/admin-area/category', [CategoryController::class, 'index']);
        Route::get('/admin-area/create/category', [CategoryController::class, 'create']);
        Route::post('/admin-area/create/category/save', [CategoryController::class, 'store']);
        Route::get('/admin-area/edit/category/{id}', [CategoryController::class, 'edit']);
        Route::put('/admin-area/edit/category/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/admin-area/delete/category/{id}', [CategoryController::class, 'destroy']);

        Route::get('/admin-area/edit/staff/{id}', [StaffController::class, 'edit']);
        Route::put('/admin-area/edit/staff-update/{id}', [StaffController::class, 'updateStaff']);

        Route::get('/admin-area/staff/change-password/{id}', [StaffController::class, 'changePassword']);
        Route::patch('/admin-area/staff/change-password/update/{id}', [StaffController::class, 'updatePassword']);

        Route::get('/admin-area/transaction', [TransactionController::class, 'index']);
        Route::get('/admin-area/transaction/{id}', [TransactionController::class, 'detailTrx']);
        Route::get('/admin-area/transaction/invoice/{id}', [TransactionController::class, 'invoice']);
        Route::delete('/admin-area/delete/transaction/{id}', [TransactionController::class, 'destroy']);
    });

    Route::middleware('auth-admin')->group(function() {
        Route::get('/admin-area/delete/customer/show', [CustomerController::class, 'showDeleted']);
        Route::get('/admin-area/restore/customer/{id}', [CustomerController::class, 'restore']);

        Route::get('/admin-area/delete/products/show', [ProductController::class, 'showDeleted']);
        Route::get('/admin-area/restore/product/{id}', [ProductController::class, 'restore']);

        Route::get('/admin-area/delete/category/show', [CategoryController::class, 'showDeleted']);
        Route::get('/admin-area/restore/category/{id}', [CategoryController::class, 'restore']);

        Route::get('/admin-area/staff', [StaffController::class, 'index']);
        Route::get('/admin-area/create/staff', [StaffController::class, 'create']);
        Route::post('/admin-area/create/staff/save', [StaffController::class, 'store']);
        Route::put('/admin-area/edit/staff/update/{id}', [StaffController::class, 'update']);
        Route::patch('/admin-area/staff/change/password/update/{id}', [StaffController::class, 'updatePassword']);
        Route::patch('/admin-area/change-status/staff/{id}', [StaffController::class, 'approve']);
        Route::delete('/admin-area/delete/staff/{id}', [StaffController::class, 'destroy']);

        Route::get('/admin-area/delete/transaction/show', [TransactionController::class, 'showDeleted']);
        Route::get('/admin-area/restore/transaction/{id}', [TransactionController::class, 'restore']);
    });

});

// Route::middleware('not_login_customer')->group(function() {
    Route::get('/customer/login', [AuthController::class, 'viewLoginCustomerArea'])->name('loginCustomer');
    Route::post('/customer/login/auth', [AuthController::class, 'authenticateCustomer'])->middleware('throttle:loginCustomer');
    Route::get('/customer/register', [AuthController::class, 'register']);
    Route::post('/customer/register/save', [AuthController::class, 'registUser']);    
    Route::get('/customer/logout', [AuthController::class, 'logoutCustomer']);
    Route::get('/customer/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('/customer/forgot-password', [AuthController::class, 'processForgotPassword'])->name('password.email');
    Route::get('/customer/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'processResetPassword'])->name('password.update');
    // });

    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/product/detail/{id}', [DashboardController::class, 'show']);
    Route::get('/products', [DashboardController::class, 'listProducts'])->name('productsList');;
    Route::get('/products/search', [DashboardController::class, 'productSearch']);
    // Route::get('/category/products-list', [DashboardController::class, 'listProductByCategory'])->name('products.listByCategory');


    Route::get('/account/verification/', [AuthController::class, 'verify']);
    Route::get('/account/verify/{id}', [AuthController::class, 'verified']);
    
    Route::get('/customer/account/{id}', [UserCustomerController::class, 'account']);
    Route::put('/customer/account/update/{id}', [UserCustomerController::class, 'customerUpdate']);
    Route::get('/customer/account/change-password/{id}', [UserCustomerController::class, 'changePassword']);
    Route::patch('/customer/account/change-password/update/{id}', [UserCustomerController::class, 'updatePassword']);
    
    Route::get('/customer/cart', [SnapController::class, 'cart']);
    Route::post('/customer/cart/{id}', [SnapController::class, 'addToCart']);
    Route::patch('/customer/cart/update/{id}', [SnapController::class, 'updateCart']);
    Route::delete('/customer/cart/remove/{id}', [SnapController::class, 'removeCart']);
    Route::post('/customer/cart/clear', [SnapController::class, 'clearCart']);
    Route::get('/customer/checkout', [SnapController::class, 'checkout']);
    Route::post('/customer/checkout', [SnapController::class, 'transaction']);
    Route::get('/customer/transaction', [SnapController::class, 'confirmTrx']);
    Route::get('/customer/transaction/history', [SnapController::class, 'history']);
