<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {

        $store = User::where('username', $request->username)->first();

        // dd($store->productCategories);

        if (!$store)
            return abort(404);

        $populars = Product::where('user_id', $store->id)->where('is_popular', true)->get();
        $product = Product::where('user_id', $store->id)->get();


        return view('Pages.index', compact('store', 'populars', 'product'));
    }
}