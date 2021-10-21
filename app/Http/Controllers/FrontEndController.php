<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function home(){
        return view('frontend.index',[
            'latests' => Product::latest()->limit(15)->get(),
            'men' => Product::where('type_name','men')->limit(8)->get(),
            'women' => Product::where('type_name','women')->limit(8)->get(),
            'kids' => Product::where('type_name','kids')->limit(8)->get(),
        ]);
    }
}
