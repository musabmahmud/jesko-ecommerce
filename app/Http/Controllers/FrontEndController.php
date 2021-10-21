<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class FrontEndController extends Controller
{
    public function home(){
        return view('frontend.index',[
            'allProducts' => Product::latest()->limit(8)->get(),
            'latests' => Product::where('type_name','default')->latest()->limit(8)->get(),
            'men' => Product::where('type_name','men')->latest()->limit(8)->get(),
            'women' => Product::where('type_name','women')->latest()->limit(8)->get(),
            'kids' => Product::where('type_name','kids')->latest()->limit(8)->get(),

            'newProducts' => Product::whereDate('created_at', Carbon::yesterday())->limit(4)->get(),
            'topArrivals' => Product::whereDate('created_at', '>=',date('Y-m'))->latest()->limit(4)->get(),
            'bestSells' => Product::latest()->limit(4)->get(),
        ]);
    }
}
