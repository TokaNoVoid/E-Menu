<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $store = User::where('username', $request->username)->first();

        if (!$store)
            return abort(404);

        $product = Product::where('id', $request->id)->where('user_id', $store->id)->first();

        if (!$product)
            return abort(404);

        return view('Pages.product', compact('store', 'product'));
    }

    public function findResults(Request $request)
    {
        // cari user/store berdasarkan username
        $store = User::where('username', $request->username)->first();

        if (! $store) {
            abort(404);
        }

        // mulai query product
        $products = Product::where('user_id', $store->id);

        // filter kategori jika dipilih
        if ($request->filled('category')) {
            $category = ProductCategory::where('user_id', $store->id)
                        ->where('slug', $request->category)
                        ->first();

            if ($category) {
                $products->where('product_category_id', $category->id);
            } else {
                // kalau slug tidak ketemu, kosongkan hasil
                $products->whereRaw('1 = 0');
            }
        }

        // filter nama menu
        if ($request->filled('search')) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }

        // eksekusi query
        $products = $products->get();

        return view('Pages.result', compact('store', 'products'));
    }

    public function find(Request $request)
    {
        $store = User::where('username', $request->username)->first();

        

        if (!$store)
            return abort(404);


        return view('Pages.find', compact('store'));
    }
}