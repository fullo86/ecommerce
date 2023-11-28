<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products  = Product::all();

        return view('frontpage/v_dashboard/dashboard', ['listCategories' => $categories, 'listProducts' => $products]);
    }

    public function navbarData()
    {
        $categories = Category::select('id', 'category_name')->get();
        return view('frontpage/layouts/main', ['listCategories' => $categories]);
    }

    public function main()
    {
        $categories = Category::all();
        $products  = Product::all();

        return view('frontpage/v_dashboard/dashboard', ['listCategories' => $categories, 'listProducts' => $products]);
    }

    public function show($id)
    {
        $categories = Category::select('id', 'category_name')->get();
        $productDetail = Product::with('sizes')->findOrFail($id);
        return view('frontpage/v_dashboard/detailProduct', ['listCategories' => $categories, 'detailProduct' => $productDetail]);
    }

    public function listProducts()
    {
        $categories = Category::select('id', 'category_name')->get();
        $products = Product::select('id', 'product_name', 'price', 'status_product', 'image_product1')->orderBy('created_at', 'desc')->paginate(9);

        return view('frontpage/v_dashboard/productsPage', ['listCategories' => $categories, 'listProducts' => $products]);
    }

    public function productSearch(Request $request)
    {
        $categories = Category::select('id', 'category_name')->get();
        $query = Product::query();
        
        if ($request->category) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('category_name', $request->category);
            });
        }

        if ($request->keyword) {
            $query->where(function ($query) use ($request) {
                $query->where('product_name', 'like', '%' . $request->keyword . '%');
            });
        }                
        
        $resultProducts = $query->paginate(9);
        
        if ($request->ajax()) {
            return response()->json(['products' => $resultProducts]);
        }

        return view('frontpage/v_dashboard/productsPage', ['listCategories' => $categories, 'listProducts' => $resultProducts]);
    }

    // public function listProductByCategory(Request $request)
    // {
    //     $categories = Category::select('id', 'category_name')->get();
    
    //     $query = Product::query();
    
    //     if ($request->category) {
    //         $query->whereHas('categories', function ($query) use ($request) {
    //             $query->where('category_name', $request->category);
    //         });
    //     }
    
    //     // if ($request->keyword) {
    //     //     $query->where(function ($query) use ($request) {
    //     //         $query->where('title', 'like', '%' . $request->keyword . '%')
    //     //               ->orWhere('book_code', 'like', '%' . $request->keyword . '%');
    //     //     });
    //     // }
    
    //     $products = $query->paginate(9);
    
    //     return view('frontpage/v_dashboard/listProductByCategory', ['listBooks' => $products, 'categoryData' => $categories]);
    // }
}
