<?php

namespace App\Http\Controllers;

use App\Models\BillingAmount;
use App\Models\BillingDetail;
use App\Models\Checkout;
use App\Models\OrderedProduct;
use App\Models\Attribute;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $billing_details = BillingDetail::where('user_id', auth()->user()->id)->first();
        $profile = Profile::where('user_id', auth()->user()->id)->first();
        return view('frontend.pages.checkout',compact('profile','billing_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (getcarts()->count() == 0) {
            return redirect('/');
        }
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'mobile_no' => ['required'],
            'payment_method' => ['required'],
        ]);

        $billing_details = new BillingDetail;
        $billing_details->user_id = $request->user_id;
        $billing_details->name = $request->name;
        $billing_details->email = $request->email;
        $billing_details->mobile_no = $request->mobile_no;
        $billing_details->city = $request->city;
        $billing_details->address = $request->address;
        $billing_details->apartment = $request->apartment;
        $billing_details->zipcode = $request->zipcode;
        $billing_details->order_note = $request->order_note;
        $billing_details->payment_method = $request->payment_method;

        $billing_details->save();
        
        $billing_account = new BillingAmount;
        $billing_account->billing_detail_id = $billing_details->id;
        $billing_account->subtotal = session('subtotal');
        $billing_account->discount = session('discount');
        $billing_account->shipping = session('shipping');
        $billing_account->grand_total = session('grand_total');

        if($request->payment_method == 'cash on delivery'){
            $billing_account->payment_status = 'unpaid';
        }
        else{
            $billing_account->payment_status = 'paid';
        }
        
        $billing_account->save();

        foreach(getCarts() as $cartItem){
            $ordered_products = new OrderedProduct;
            $ordered_products->billing_amount_id = $billing_account->id;
            $ordered_products->product_id = $cartItem->id;
            $ordered_products->color_id = $cartItem->color_id;
            $ordered_products->size = $cartItem->size;
            $ordered_products->quantity = $cartItem->quantity;

            $ordered_products->save();

            $quantity_decrement = Attribute::where('product_id',$cartItem->product_id)->where('color_id',$cartItem->color_id)->decrement("quantity", $cartItem->quantity);

            $cartItem->delete();
        }

        if(!empty(session('coupon'))){
            $coupon = session('coupon');
            $coupon_limit = 1;
            $coupon_decrement = Coupon::where('coupon_name',$coupon->coupon_name)->decrement("coupon_limit", $coupon_limit);
        }

        session()->put('subtotal','0');
        session()->put('discount','0');
        session()->put('grand_total','0');
        session()->put('shipping', '0');
        session()->forget('coupon');

        return back()->with('success','Product Ordered Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
