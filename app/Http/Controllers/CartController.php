<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'color_id' => ['required'],
            'size' => ['required'],
            'quantity' => 'integer|min:1|max:99',
        ]);
        $product = Product::findOrFail($request->product_id);
        if ($request->hasCookie('jesko_id')) {
            $generate_id = $request->cookie('jesko_id');
        }else {
            $generate_id = Cookie::queue('jesko_id', Str::random(10), 604800);
        }
        if (Cart::where('cookie_id', $generate_id)->where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size', $request->size)->exists()) {
            return redirect('products/'.$product->product_slug.'#productDetails')->with('error','Product already Added');
        }else {
            $cart = new Cart();
            $cart->cookie_id = $generate_id;
            $cart->product_id = $request->product_id;
            $cart->color_id = $request->color_id;
            $cart->size = $request->size;
            $cart->quantity = $request->quantity;
            $cart->save();
            return redirect('products/'.$product->product_slug.'#productDetails')->with('success','Added Product To Cart');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
