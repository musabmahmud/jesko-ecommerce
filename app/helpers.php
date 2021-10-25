<?php 

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Attribute;
use Illuminate\Support\Facades\Cookie;


function getCarts()
{
    return Cart::where("cookie_id", Cookie::get('jesko_id'))->get();
}
function getCartCount(){
    return Cart::where("cookie_id", Cookie::get('jesko_id'))->count();
}
function getCartAmount(){
    $cart = Cart::where("cookie_id", Cookie::get('jesko_id'))->get();
    $attr = Attribute::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size', $cart->size)->get();
    $offer_price = $attr->sum('offer_price');
    return $offer_price;

}
function getPrice($cartPro)
{
    $attr = Attribute::where(['product_id' => $cartPro->product_id, 'color_id' => $cartPro->color_id, 'size' => $cartPro->size])->first();
    if($attr->price > $attr->offer_price){
        return $attr->offer_price;
    }
    else{
        return $attr->price;
    }
}
function attribute($pdt_id, $color_id, $size)
{
    return Attribute::where(['product_id' => $pdt_id, 'color_id' => $color_id, 'size_id' => $size])->first();
}

function discounted($total, $discount)
{
    return $total - ($total * ($discount / 100));
}
function coupon()
{
    return Coupon::orderby('created_at', 'desc')->first();
}

?>