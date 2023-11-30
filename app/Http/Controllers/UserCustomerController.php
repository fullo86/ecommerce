<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class UserCustomerController extends Controller
{
    public function account()
    {   
        $categories = Category::select('id', 'category_name')->get();
        $dataProvince = Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->get('https://api.rajaongkir.com/starter/province');
        $responseProv = $dataProvince->json()['rajaongkir']['results'];

        $dataCities = Http::withHeaders([
            'key' => 'f8f3496830f0aef514343e120e23f713',
        ])->get('https://api.rajaongkir.com/starter/city');
        $responseCity = $dataCities->json()['rajaongkir']['results'];

        return view('frontpage/v_customer/account', ['listCategories' => $categories, 'dataApi1' => $responseProv, 'dataApi2' => $responseCity]);
    }

    public function customerUpdate(Request $request, $id)
    {
        $updateCustomer = Customer::findOrFail($id);
        $data = $request->all();

        if ($request->file('image_profile')) {
            // Unlink Image from storage
            if ($updateCustomer->image_profile != 'default.png' && file_exists(public_path('storage/images/profile/' . $updateCustomer->image_profile))) {
                unlink(public_path('storage/images/profile/' . $updateCustomer->image_profile));
            }
            
            // Mengunggah gambar yang baru
            $extension = $request->file('image_profile')->getClientOriginalExtension();
            $newName = $updateCustomer->username . '-' . now()->timestamp . '.' . $extension;
            $request->file('image_profile')->storeAs('public/images/profile/', $newName);

            //Resize Image
            $image = Image::make(storage_path('app/public/images/profile/' . $newName));
            $image->resize(1024, 1024);
            $image->save(storage_path('app/public/images/profile/' . $newName));

            // Menyimpan nama gambar yang baru ke dalam data yang akan diupdate
            $data['image_profile'] = $newName;
            $data['updated_at']  = Carbon::now();
        }
        $updateCustomer->update($data);
    
        // Session::flash('status', 'success');
        // Session::flash('message', 'Berhasil Mengupdate Data Customer');
        return redirect('/customer/account/'.$updateCustomer->id);
    }

    public function changePassword($id)
    {
        $categories = Category::select('id', 'category_name')->get();
        $customerPassword = Customer::findOrFail($id);

        return view('frontpage/v_customer/changePassword', ['listCategories' => $categories, 'customerData' => $customerPassword]);
    }

    public function updatePassword(Request $request, $id)
    {
        $data = Customer::findOrFail($id);

        if ($data) {
            if (!Hash::check($request->old_password, auth()->guard('customer')->user()->password)) {
                Session::flash('status', 'failed');
                Session::flash('message', 'Password Lama Salah');
                return redirect('/customer/account/change-password/'.$data->id);
            }

            if ($request->new_password != $request->repeat_password) {
                Session::flash('status', 'failed');
                Session::flash('message', 'Konfirmasi Password Tidak Sama');
                return redirect('/customer/account/change-password/'.$data->id);
            }

            auth()->guard('customer')->user()->update([
                'password' => Hash::make($request->new_password)
            ]);
            Session::flash('status', 'success');
            Session::flash('message', 'Password Berhasil Diubah');
            return redirect('/customer/account/change-password/'.$data->id);
        }
    }
}
