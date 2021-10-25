@extends('frontend.master')
@section('content')
        <!-- breadcrumb-area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 text-center">
                        <h2 class="breadcrumb-title">Shop</h2>
                        <!-- breadcrumb-list start -->
                        <ul class="breadcrumb-list">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">Cart</li>
                        </ul>
                        <!-- breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    
        <!-- breadcrumb-area end -->
    
        <!-- Cart Area Start -->
        <div class="cart-main-area pt-100px pb-100px" id="cartDetails">
            <div class="container">
                <h3 class="cart-page-title">Your cart items</h3>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        @if (session('success'))
                            <div class="alert bg-success text-white">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Until Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                        $total = 0;
                                        $discount = 0;
                                        $coupon = session('coupon');
                                    @endphp
                                    @forelse (getCarts() as $cartItem)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img class="img-responsive ml-15px"
                                                    src="{{asset('products')}}/{{$cartItem->product->thumbnail}}" alt="{{$cartItem->product->product_name}}" /></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{$cartItem->product->product_name}}</a></td>
                                        <td class="product-price-cart"><span class="amount text-uppercase">{{$cartItem->color->color_name}}</span></td>
                                        <td class="product-price-cart"><span class="amount">{{$cartItem->size}}</span></td>
                                        <td class="product-price-cart"><span class="amount">${{getPrice($cartItem)}}</span></td>
                                            <td class="product-quantity">
                                            <form action="{{route('cart.update',['cart' => $cartItem->id])}}" method="POST">
                                            {{method_field('PUT')}}
                                                @csrf
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="quantity"
                                                    value="{{$cartItem->quantity}}" />
                                            </div>
                                        </td>
                                        <td class="product-subtotal">${{getPrice($cartItem) * $cartItem->quantity}}</td>
                                        <td class="product-remove">
                                            <button type="submit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('cart.destroy', ['cart' => $cartItem->id]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"><i class="fa fa-times"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $subtotal = $subtotal + getPrice($cartItem) * $cartItem->quantity;?>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="30">No Data Available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="#">Continue Shopping</a>
                                    </div>
                                    <div class="cart-clear">
                                        <a href="{{route('clearCart')}}">Clear Shopping Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="coupon">
                            <div class="col-lg-4 col-md-6 mb-lm-30px">
                                <div class="discount-code-wrapper">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray">Use Coupon Code</h4>
                                    </div>
                                    <div class="discount-code">
                                        <p>Enter your coupon code if you have one.</p>
                                        <form method="POST"
                                                action="{{ route('getCoupon')}}">
                                                @csrf
                                            <input type="text" required=""
                                            @isset($coupon)
                                                value="{{$coupon->coupon_name}}"
                                            @endisset name="coupon_name" />
                                            
                                            <button class="cart-btn-2" type="submit">Apply Coupon</button>
                                        </form>
                                    </div>
                                </div>
                                @if (session('error'))
                                    <div class="alert bg-color text-white">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @isset($coupon)
                                    <div class="alert bg-success text-white">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        Coupon Applied
                                    </div>
                                @endisset
                            </div>
                            <div class="col-lg-4 col-md-6 mb-lm-30px">
                            </div>
                            <div class="col-lg-4 col-md-12 mt-md-30px">
                                <div class="grand-totall">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                    </div>
                                    <h5>Total products <span>${{$subtotal}}</span></h5>
                                    <h5>Shipping Cost<span>${{$shipping = 3}}</span></h5>
                                    @isset($coupon)
                                        <h5>Discount {{$coupon->coupon_percentage}}%<span>- ${{$discount = $coupon->coupon_percentage * $subtotal/100}}</span></h5>
                                    @endisset
                                    <hr>
                                    @if(isset($coupon))
                                        <h4 class="grand-totall-title">Grand Total <span>${{$total = $subtotal + $shipping - $discount}}</span></h4>
                                    @else
                                        <h4 class="grand-totall-title">Grand Total <span>${{$total = $subtotal + $shipping}}</span></h4>
                                    @endif
                                    <a href="{{route('checkout.index')}}">Proceed to Checkout</a>
                                </div>
                                @php
                                    session()->put('subtotal',$subtotal);
                                    session()->put('discount',$discount);
                                    session()->put('grand_total',$total);
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Area End -->
@endsection