<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

    public function find(Request $request)
    {
        $store = User::where('username', $request->username)->first();

        

        if (!$store)
            return abort(404);


        return view('Pages.find', compact('store'));
    }
}