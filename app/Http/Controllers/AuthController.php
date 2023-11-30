<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Mail\VerifEmailCustomer;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
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
                Session::flash('status', 'success');
                Session::flash('message', 'Selamat Datang Di-Dashboard '.Auth::user()->name);
                return redirect('/administrator/dashboard');
            }

            //cek login if staff
            if (Auth::user()->role_id == 2) {
                Session::flash('status', 'success');
                Session::flash('message', 'Selamat Datang Di-Dashboard '.Auth::user()->name);
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
        $request->validate([
            'password' => 'required|min:8',
        ]);

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

    public function forgotPassword()
    {
        $categories = Category::select('id', 'category_name')->get();
        return view('frontpage/auth/forgotPassword', ['listCategories' => $categories]);
    }

    public function processForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        // Mail::to($request->email)->send(new ResetPassword($status));

        if ($status === Password::RESET_LINK_SENT) {
            Session::flash('status', 'success');
            Session::flash('message', 'Link Reset Password Berhasil Terkirim, Silahkan cek Email');    
            return redirect('/customer/forgot-password');
        }else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Email Tidak Terdaftar');    
            return redirect('/customer/forgot-password');
        }
    }

    public function resetPassword($token)
    {
        $categories = Category::select('id', 'category_name')->get();
        return view('frontpage/auth/resetPassword', ['listCategories' => $categories, 'token' => $token]);
    }

    public function processResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            Session::flash('status', 'success');
            Session::flash('message', 'Password Berhasil Di-Reset, Silahkan Login');    
            return redirect('/customer/login');
        }else{
            return back()->withErrors(['email' => [__($status)]]);
        }
        // return $status === Password::PASSWORD_RESET
        //         ? redirect()->route('login')->with('status', __($status))
        //         : back()->withErrors(['email' => [__($status)]]);
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
