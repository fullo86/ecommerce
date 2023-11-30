<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('adminarea/v_category/category', ['listCategories' => $category]);
    }

    public function create()
    {
        return view('adminarea/v_category/addCategory');
    }

    public function store(CategoryRequest $request)
    {
        $id = Str::uuid();
        $data = $request->all();
        $data['id'] = $id->toString();
        $newCategory = Category::create($data);

        if (!$newCategory) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Menambahkan Kategori Baru');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menambahkan Kategori Baru');
        return redirect('/admin-area/category');
    }

    public function edit($id)
    {
        $categoryValue = Category::findOrFail($id);
        return view('adminarea/v_category/editCategory', ['category' => $categoryValue]);
    }

    public function update(CategoryRequest $request, $id)
    {
        $updateCategory = Category::findOrFail($id);

        if (!$updateCategory) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Mengupdate Data Kategori');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Mengupdate Data Kategori');
        $updateCategory->update($request->all());  
        return redirect('/admin-area/category');
    }

    public function destroy($id)
    {
        $removeCategory = Category::findOrFail($id);
        $removeCategory->delete();

        if (!$removeCategory) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Menghapus Data Kategori');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menghapus Data Kategori');
        return redirect('/admin-area/category');
    }

    public function showDeleted()
    {
        $deletedCategory = Category::onlyTrashed()->get();
        return view('adminarea/v_category/showDeleteCategory', ['categoryDeleted' => $deletedCategory]);
    }

    public function restore($id)
    {
        $restoreCategory = Category::withTrashed()->where('id', $id)->restore();

        if (!$restoreCategory) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Restore Data Kategori');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Merestore Data Kategori');
        return redirect('/admin-area/category');
    }
}
