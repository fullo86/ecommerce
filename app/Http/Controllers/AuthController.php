<?php

namespace App\Http\Controllers;

use App\Mail\VerifEmailCustomer;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function viewLoginAdminArea() 
    {
        return view('adminarea/auth/login');
    }

    public function viewLoginCustomerArea() 
    {
        $categories = Category::select('id', 'category_name')->get();

        return view('frontpage/auth/login', ['listCategories' => $categories]);
    }

    public function register() 
    {
        $categories = Category::select('id', 'category_name')->get();
        
        return view('frontpage/auth/register', ['listCategories' => $categories, ]);
    }

    public function authenticateAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username'  => ['required'],
            'password'  => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            //Cek status user apakah masih tidak aktif
            if (Auth::user()->active_status != 'active') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
        
                Session::flash('status', 'failed');
                Session::flash('message', 'Akun Anda Nonaktif');
                return redirect('/auth/admin');
            }

            //cek login if admin
            $request->session()->regenerate();
            if (Auth::user()->role_id  == 1) {
                return redirect('/administrator/dashboard');
            }

            //cek login if staff
            if (Auth::user()->role_id == 2) {
                return redirect('/administrator/dashboard');
            }
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Login Gagal');
        return redirect('/auth/admin');
    }

    public function authenticateCustomer(Request $request)
    {
        $credentials = $request->validate([
            'username'  => ['required'],
            'password'  => ['required']
        ]);
        if (Auth::guard('customer')->attempt($credentials)) {
            //Cek status user apakah masih tidak aktif
            if (auth()->guard('customer')->user()->active_status != 'active') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                Session::flash('status', 'failed');
                Session::flash('message', 'Akun Anda Belum Aktif');
                return redirect('/customer/login');                
            }

            //cek login if admin
            $request->session()->regenerate();
            if (auth()->guard('customer')->user()) {
                return redirect('/');
            }
        }
        Session::flash('status', 'failed');
        Session::flash('message', 'Username/Password Salah');
        return redirect('/customer/login');
    }

    public function registUser(Request $request)
    {
        // customer make uuid
        $id = Str::uuid();
        $request['id'] = $id->toString();

        //hash password
        $request['password'] = Hash::make($request->password);
        $request['image_profile'] = 'default.png';
        $data = Customer::create($request->all());
        Mail::to($data->email)->send(new VerifEmailCustomer($data));

        if ($data) {
            Session::flash('status', 'success');
            Session::flash('message', 'Pendaftaran Berhasil, Cek Email Anda Untuk Aktivasi Akun');
        }

        return redirect('/customer/register');
    }

    public function verified($id)
    {
        $verification = Customer::findOrFail($id);

        if ($verification) {
            $verification->active_status = 'active';
            $verification->save();

            Session::flash('status', 'success');
            Session::flash('message', 'Verifikasi Sukses, Silahkan Masuk');
            return redirect('/customer/login');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Verifikasi Gagal');    
        return redirect('/customer/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth/admin');
    }

    public function logoutCustomer(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/customer/login');
    }
}
