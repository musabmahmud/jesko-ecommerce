<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
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
    public function productDetails($slug){
        $pdtDetail =Product::where('product_slug',$slug)->first();
        $attributes = Attribute::where('product_id', $pdtDetail->id)->get();
        $groups = collect($attributes)->groupBy('color_id');
        return view('frontend.pages.single_product', compact('pdtDetail','groups'));
    }

    public function getSize($colorId,$productId){
        $output = '';
        $attributes = Attribute::where('product_id',$productId)->where('color_id',$colorId)->get();
        foreach($attributes as $key => $attribute){
            $output = $output.'<input type="radio" data-quantity="'.$attribute->quantity.'" value="'.$attribute->size.'" data-price="'.$attribute->price.'" data-offerprice="'.$attribute->offer_price.'" name="size" id="'.$attribute->id.'" class="sizecheck">
            <label for="size">'.$attribute->size.'</label>';
        }
        return $output;
        return response()->json($output);
    }
    public function customerLogin(){
        return view('frontend.pages.login');
    }
    public function customerRegister(){
        return view('frontend.pages.register');
    }
    public function myAccount(){
        if(auth()->user()){
            return view('frontend.pages.my_account');
        }
        else{
            return redirect('customer-login');
        }
    }

}
