<?php

namespace App\Http\Controllers\administrator;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('adminarea/v_product/product', ['listProducts' => $products]);
    }

    public function create()
    {
        $categories = Category::all();
        $sizes      = Size::select('id', 'size_name')->get();

        return view('adminarea/v_product/addProduct', ['listCategories' => $categories, 'listSizes' => $sizes]);
    }

    public function store(Request $request)
    {
        $newNameImg1 = '';
        $newNameImg2 = '';
        $newNameImg3 = '';
        $randNameImg1 = Str::random(20);
        $randNameImg2 = Str::random(20);
        $randNameImg3 = Str::random(20);

        //If User Upload Image Product 1
        if ($request->file('image_product1')) {
            $extension = $request->file('image_product1')->getClientOriginalExtension();
            $newNameImg1 = $randNameImg1.'-'.now()->timestamp.'.'.$extension;
            $request->file('image_product1')->storeAs('public/images/product', $newNameImg1);

            //Resize Image
            $image = Image::make(storage_path('app/public/images/product/' . $newNameImg1));
            $image->resize(800, 800);
            $image->save(storage_path('app/public/images/product/' . $newNameImg1));
        }

        //If User Upload Image Product 2
        if ($request->file('image_product2')) {
            $extension = $request->file('image_product2')->getClientOriginalExtension();
            $newNameImg2 = $randNameImg2.'-'.now()->timestamp.'.'.$extension;
            $request->file('image_product2')->storeAs('public/images/product', $newNameImg2);

            //Resize Image
            $image = Image::make(storage_path('app/public/images/product/' . $newNameImg2));
            $image->resize(800, 800);
            $image->save(storage_path('app/public/images/product/' . $newNameImg2));
        }else{
            $newNameImg2 = 'default_product.jpg';
        }

        //If User Upload Image Product 3
        if ($request->file('image_product3')) {
            $extension = $request->file('image_product3')->getClientOriginalExtension();
            $newNameImg3 = $randNameImg3.'-'.now()->timestamp.'.'.$extension;
            $request->file('image_product3')->storeAs('public/images/product', $newNameImg3);


            //Resize Image
            $image = Image::make(storage_path('app/public/images/product/' . $newNameImg3));
            $image->resize(800, 800);
            $image->save(storage_path('app/public/images/product/' . $newNameImg3));
        }else{
            $newNameImg3 = 'default_product.jpg';
        }

        $id = Str::uuid();
        $code_product = Str::random(8);
        $result_cdpdt = strtoupper($code_product);
        $data = $request->all();
        $data['id'] = $id->toString();
        $data['image_product1'] = $newNameImg1;
        $data['image_product2'] = $newNameImg2;
        $data['image_product3'] = $newNameImg3;
        $data['product_code'] = $result_cdpdt;

        $newProduct = Product::create($data);
        $newProduct->categories()->sync($data['categories']);
        $newProduct->sizes()->sync($data['sizes']);

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menambahkan Produk Baru');
        return redirect('/admin-area/products');
    }

    public function edit($id)
    {
        $productValue = Product::findOrFail($id);
        $categories   = Category::all();
        $sizes        = Size::all();

        $selectedCategories = $productValue->categories->pluck('id')->toArray();
        $selectedSizes = $productValue->sizes->pluck('id')->toArray();
        return view('adminarea/v_product/editProduct', ['productValue' => $productValue, 'categoryValue' => $categories, 'selectedCategories' => $selectedCategories, 'sizeValue' => $sizes,'selectedSizes' => $selectedSizes]);
    }

    public function update(Request $request, $id)
    {
        $updateProduct = Product::findOrFail($id);
        $data = $request->all();
        $randNameImg1 = Str::random(20);
        $randNameImg2 = Str::random(20);
        $randNameImg3 = Str::random(20);

        if ($request->file('image_product1')) {
            // Unlink Image product 1 from storage
            if ($updateProduct->image_product1 != 'default_product.jpg' && file_exists(public_path('storage/images/product/' . $updateProduct->image_product1))) {
                unlink(public_path('storage/images/product/' . $updateProduct->image_product1));
            }
            
            // Mengunggah gambar yang baru
            $extension1 = $request->file('image_product1')->getClientOriginalExtension();
            $newNameImg1 = $randNameImg1 . '-' . now()->timestamp . '.' . $extension1;
            $request->file('image_product1')->storeAs('public/images/product/', $newNameImg1);

            //Resize Image
            $image = Image::make(storage_path('app/public/images/product/' . $newNameImg1));
            $image->resize(800, 800);
            $image->save(storage_path('app/public/images/product/' . $newNameImg1));

            // Menyimpan nama gambar yang baru ke dalam data yang akan diupdate
            $data['image_product1'] = $newNameImg1;
            $data['updated_at']  = Carbon::now();
        }

        if ($request->file('image_product2')) {
            // Unlink Image product 2 from storage
            if ($updateProduct->image_product2 != 'default_product.jpg' && file_exists(public_path('storage/images/product/' . $updateProduct->image_product2))) {
                unlink(public_path('storage/images/product/' . $updateProduct->image_product2));
            }
            
            // Mengunggah gambar yang baru
            $extension = $request->file('image_product2')->getClientOriginalExtension();
            $newNameImg2 = $randNameImg2 . '-' . now()->timestamp . '.' . $extension;
            $request->file('image_product2')->storeAs('public/images/product/', $newNameImg2);
    
            //Resize Image
            $image = Image::make(storage_path('app/public/images/product/' . $newNameImg2));
            $image->resize(800, 800);
            $image->save(storage_path('app/public/images/product/' . $newNameImg2));

            // Menyimpan nama gambar yang baru ke dalam data yang akan diupdate
            $data['image_product2'] = $newNameImg2;
            $data['updated_at']  = Carbon::now();
        }

        if ($request->file('image_product3')) {
            // Unlink Image product 3 from storage
            if ($updateProduct->image_product3 != 'default_product.jpg' && file_exists(public_path('storage/images/product/' . $updateProduct->image_product3))) {
                unlink(public_path('storage/images/product/' . $updateProduct->image_product3));
            }
            
            // Mengunggah gambar yang baru
            $extension = $request->file('image_product3')->getClientOriginalExtension();
            $newNameImg3 = $randNameImg3 . '-' . now()->timestamp . '.' . $extension;
            $request->file('image_product3')->storeAs('public/images/product/', $newNameImg3);
    
            //Resize Image
            $image = Image::make(storage_path('app/public/images/product/' . $newNameImg3));
            $image->resize(800, 800);
            $image->save(storage_path('app/public/images/product/' . $newNameImg3));

            // Menyimpan nama gambar yang baru ke dalam data yang akan diupdate
            $data['image_product3'] = $newNameImg3;
            $data['updated_at']  = Carbon::now();
        }

        $updateProduct->update($data);
    
        if ($request->categories) {
            $updateProduct->categories()->sync($request->categories);
        }

        if ($request->sizes) {
            $updateProduct->sizes()->sync($request->sizes);
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Mengupdate Data Produk');
        return redirect('/admin-area/products');
    }

    public function statusProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->status_product != 'published') {
            $product->status_product = 'published';
            $product->save();

            Session::flash('status', 'success');
            Session::flash('message', 'Status Produk Berhasil Di-Publish');
            return redirect('/admin-area/products');
        }else{
            $product->status_product = 'unpublished';
            $product->save();

            Session::flash('status', 'success');
            Session::flash('message', 'Status Produk Berhasil Di-Unpublish');
            return redirect('/admin-area/products');          
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Status Produk Gagal Di-Publish');
        return redirect('/admin-area/products');
    }

    public function destroy($id)
    {
        $removeProduct = Product::findOrFail($id);

        // if ($removeProduct->image_product1) {
        //     if ($removeProduct->image_product1 != 'default_product.jpg' && file_exists(public_path('storage/images/product/' . $removeProduct->image_product1))) {
        //         unlink(public_path('storage/images/product/' . $removeProduct->image_product1));
        //     }
        // }

        // if ($removeProduct->image_product2) {
        //     if ($removeProduct->image_product2 != 'default_product.jpg' && file_exists(public_path('storage/images/product/' . $removeProduct->image_product2))) {
        //         unlink(public_path('storage/images/product/' . $removeProduct->image_product2));
        //     }
        // }

        // if ($removeProduct->image_product3) {
        //     if ($removeProduct->image_product3 != 'default_product.jpg' && file_exists(public_path('storage/images/product/' . $removeProduct->image_product3))) {
        //         unlink(public_path('storage/images/product/' . $removeProduct->image_product3));
        //     }
        // }

        if (!$removeProduct) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Menghapus Data Produk');
        }

        $removeProduct->delete();
        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Menghapus Data Produk');
        return redirect('/admin-area/products');
    }

    public function showDeleted()
    {
        $deletedProducts = Product::onlyTrashed()->get();
        return view('adminarea/v_product/showDeleteProducts', ['productsDeleted' => $deletedProducts]);
    }

    public function restore($id)
    {
        $restoreProduct = Product::withTrashed()->where('id', $id)->restore();

        if (!$restoreProduct) {
            Session::flash('status', 'failed');
            Session::flash('message', 'Gagal Restore Data Produk');
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil Merestore Data Produk');
        return redirect('/admin-area/products');
    }
}
