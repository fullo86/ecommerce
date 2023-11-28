<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        return view('adminarea/v_customer/customer', ['listCustomers' => $customer]);
    }

    public function edit($id)
    {
        $customerValue = Customer::findOrFail($id);
        return view('adminarea/v_customer/editCustomer', ['customerValue' => $customerValue]);
    }

    public function update(Request $request, $id)
    {
        $updateCustomer = Customer::findOrFail($id);
        $data = $request->all();

        if ($request->file('image_profile')) {
            // Unlink Image from storage
            if (file_exists(public_path('storage/images/profile/' . $updateCustomer->image_profile))) {
                unlink(public_path('storage/images/profile/' . $updateCustomer->image_profile));
            }
            
            // Mengunggah gambar yang baru
            $extension = $request->file('image_profile')->getClientOriginalExtension();
            $newName = $request->username . '-' . now()->timestamp . '.' . $extension;
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
    
        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Mengupdate Data Customer');
        return redirect('/admin-area/customer');
    }

    public function destroy($id)
    {
            $removeCustomer = Customer::findOrFail($id);

            if ($removeCustomer->image_profile) {
                // Unlink Image from storage
                if ($removeCustomer->image_profile != 'default.png' && file_exists(public_path('storage/images/profile/' . $removeCustomer->image_profile))) {
                    unlink(public_path('storage/images/profile/' . $removeCustomer->image_profile));
                }

            if (!$removeCustomer) {
                Session::flash('status', 'failed');
                Session::flash('message', 'Gagal Menghapus Data Customer');
            }

            $removeCustomer->delete();
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil Menghapus Data Customer');
            return redirect('/admin-area/customer');
        }
    }

    public function showDeleted()
    {
        $deletedCustomer = Customer::onlyTrashed()->get();
        return view('adminarea/v_customer/showDeleteCustomer', ['customerDeleted' => $deletedCustomer]);
    }

    public function restore($id)
    {
        $restoreCustomer = Customer::withTrashed()->where('id', $id)->restore();

        if (!$restoreCustomer) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Restore Data Customer');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Merestore Data Customer');
        return redirect('/admin-area/customer');
    }
}