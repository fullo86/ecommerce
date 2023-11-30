<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('adminarea/v_staff/staff', ['listStaff' => $data]);
    }

    public function create()
    {
        return view('adminarea/v_staff/addStaff');
    }

    public function store(UserRequest $request)
    {
        $request->validate([
            'username' => 'unique:users',
            'password' => 'required|min:8',
        ]);

        //random uuid
        $id = Str::uuid();
        $request['id'] = $id->toString();

        //hash password
        $request['password'] = Hash::make($request->password);
        $request['image_profile'] = 'default.png';

        $request['role_id'] = 2;
        $data = User::create($request->all());

        if ($data) {
            Session::flash('status', 'success');
            Session::flash('message', 'Berhasil Menambahkan Staff Baru');
        }
        return redirect('/admin-area/staff');
    }

    public function edit($id)
    {
        $staffValue = User::findOrFail($id);

        return view('adminarea/v_staff/editStaff', ['staffValue' => $staffValue]);
    }

    public function update(UserRequest $request, $id)
    {
        $updateStaff = User::findOrFail($id);
        $data = $request->all();

        if ($request->file('image_profile')) {
            // Unlink Image Staff from storage
            if ($updateStaff->image_profile != 'default.png' && file_exists(public_path('storage/images/profile/' . $updateStaff->image_profile))) {
                unlink(public_path('storage/images/profile/' . $updateStaff->image_profile));
            }
            
            // Upload new Profile Image Staff
            $extension1 = $request->file('image_profile')->getClientOriginalExtension();
            $newName = $request->username . '-' . now()->timestamp . '.' . $extension1;
            $request->file('image_profile')->storeAs('public/images/profile/', $newName);
    
            // Menyimpan nama gambar yang baru ke dalam data yang akan diupdate
            $data['image_profile'] = $newName;
            $data['updated_at']  = Carbon::now();
        }

        $updateStaff->update($data);

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Mengupdate Data Staff');
        return redirect('/admin-area/staff');
    }

    public function updateStaff(UserRequest $request, $id)
    {
        $updateStaff = User::findOrFail($id);
        $data = $request->all();

        if ($request->file('image_profile')) {
            // Unlink Image Staff from storage
            if ($updateStaff->image_profile != 'default.png' && file_exists(public_path('storage/images/profile/' . $updateStaff->image_profile))) {
                unlink(public_path('storage/images/profile/' . $updateStaff->image_profile));
            }
            
            // Upload new Profile Image Staff
            $extension1 = $request->file('image_profile')->getClientOriginalExtension();
            $newName = $request->username . '-' . now()->timestamp . '.' . $extension1;
            $request->file('image_profile')->storeAs('public/images/profile/', $newName);
    
            // Menyimpan nama gambar yang baru ke dalam data yang akan diupdate
            $data['image_profile'] = $newName;
            $data['updated_at']  = Carbon::now();
        }

        $updateStaff->update($data);

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Mengupdate Data');
        return redirect('/administrator/dashboard');
    }

    public function changePassword($id)
    {
        $staffPassword = User::findOrFail($id);
        return view('adminarea/v_staff/changePassword', ['staffData' => $staffPassword]);
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:8',
        ]);

        $data = User::findOrFail($id);

        if ($data) {
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                Session::flash('status', 'failed');
                Session::flash('message', 'Password Lama Salah');
                return redirect('/admin-area/staff/change-password/'.$data->id);
            }

            if ($request->new_password != $request->repeat_password) {
                Session::flash('status', 'failed');
                Session::flash('message', 'Konfirmasi Password Tidak Sama');
                return redirect('/admin-area/staff/change-password/'.$data->id);
            }

            auth()->user()->update([
                'password' => Hash::make($request->new_password)
            ]);
            Session::flash('status', 'success');
            Session::flash('message', 'Password Berhasil Diubah');
            return redirect('/admin-area/staff/change-password/' . $data->id);
        }
    }
    
    public function approve($id)
    {
        $staff = User::findOrFail($id);

        if ($staff->active_status != 'active') {
            $staff->active_status = 'active';
            $staff->save();

            Session::flash('status', 'success');
            Session::flash('message', 'Status Staff Diaktifkan');
            return redirect('/admin-area/staff');
        }else{
            $staff->active_status = 'inactive';
            $staff->save();

            Session::flash('status', 'success');
            Session::flash('message', 'Status Staff Dinonaktifkan');
            return redirect('/admin-area/staff');          
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Status Staff Gagal Diaktifkan');
        return redirect('/admin-area/staff');
    }

    public function destroy($id)
    {
        $removeStaff = User::findOrFail($id);

        if ($removeStaff->image_profile) {
            if ($removeStaff->image_profile != 'default.png' && file_exists(public_path('storage/images/profile/' . $removeStaff->image_profile))) {
                unlink(public_path('storage/images/profile/' . $removeStaff->image_profile));
            }
        }

        if (!$removeStaff) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Menghapus Data Staff');
        }

        $removeStaff->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menghapus Data Staff');
        return redirect('/admin-area/staff');
    }
}
