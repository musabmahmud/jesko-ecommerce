@extends('frontend.master');
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
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->


    <form action="{{route('checkout.store')}}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id}}"/>
    <!-- checkout area start -->
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert bg-success text-white">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-7">
                    <div class="billing-info-wrap">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Name</label>
                                    <input type="text" value="{{ auth()->user()->name ?? '' }}" name="name" id="name"/>
                                    <p>
                                        @error('name')
                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Email</label>
                                    <input type="email" value="{{ auth()->user()->email ?? '' }}" name="email" id="email"/>
                                    <p>
                                        @error('email')
                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-select mb-4">
                                    <label>Country</label>
                                    <select>
                                        <option>Bangladesh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Town / City</label>
                                    <input type="text" name="city" value="{{ $billing_details->city ?? '' }}" id="city"/>
                                    <p>
                                        @error('city')
                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="billing-info mb-4">
                                    <label>Street Address</label>
                                    <input class="billing-address" placeholder="House number and street name"  type="text" name="address" id="address" value="{{ $billing_details->address ?? '' }}"/>
                                    <p>
                                        @error('address')
                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                        @enderror
                                    </p>
                                    <input placeholder="Flat Number and Floor Number etc." type="text" name="apartment" value="{{ $billing_details->apartment ?? '' }}"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Postcode / ZIP</label>
                                    <input type="text" name="zipcode" value="{{ $billing_details->zipcode ?? '' }}" id="zipcode"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="billing-info mb-4">
                                    <label>Phone</label>
                                    <input type="text" name="mobile_no" id="mobile_no" value="{{ $billing_details->mobile_no ?? '' }}"/>
                                    <p>
                                        @error('mobile_no')
                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                        @enderror
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="additional-info-wrap">
                            <h4>Additional information</h4>
                            <div class="additional-info">
                                <label>Order notes</label>
                                <textarea placeholder="Notes about your order, e.g. special notes for delivery. "
                                    name="order_note">{{ $billing_details->order_note ?? '' }}</textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                    <div class="your-order-area">
                        <h3>Your order</h3>
                        <div class="your-order-wrap gray-bg-4">
                            <div class="your-order-product-info">
                                <div class="your-order-top">
                                    <ul>
                                        <li>Product</li>
                                        <li>Total</li>
                                    </ul>
                                </div>
                                <div class="your-order-middle">
                                    <ul>
                                        @foreach (getCarts() as $cartItem)
                                            <li><span class="order-middle-left">{{$cartItem->product->product_name}} X {{$cartItem->quantity}}</span> <span
                                            class="order-price">${{getPrice($cartItem) * $cartItem->quantity}} </span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="order-total">Sub Total</li>
                                        <li>${{session('subtotal')}}</li>
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Shipping</li>
                                        <li>${{session('shipping')}}</li>
                                    </ul>
                                </div>
                                <div class="your-order-bottom">
                                    <ul>
                                        <li class="your-order-shipping">Discount</li>
                                        <li>-${{session('discount')}}</li>
                                    </ul>
                                </div>
                                <div class="your-order-total">
                                    <ul>
                                        <li class="order-total">Total</li>
                                        <li>${{session('grand_total')}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion element-mrg">
                                    <div id="faq" class="panel-group">
                                        <div class="panel panel-default single-my-account m-0">
                                            <div class="panel-heading my-account-title">
                                                <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                        href="#my-account-1" class="collapsed"
                                                        aria-expanded="true">Direct bank transfer</a>
                                                </h4>
                                            </div>
                                            <div id="my-account-1" class="panel-collapse collapse"
                                                data-bs-parent="#faq">

                                                <div class="panel-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town,
                                                        Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default single-my-account m-0">
                                            <div class="panel-heading my-account-title">
                                                <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                        href="#my-account-2" aria-expanded="false"
                                                        class="collapsed">Check payments</a></h4>
                                            </div>
                                            <div id="my-account-2" class="panel-collapse collapse"
                                                data-bs-parent="#faq">

                                                <div class="panel-body">
                                                    <p>Please send a check to Store Name, Store Street, Store Town,
                                                        Store State / County, Store Postcode.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default single-my-account m-0">
                                            <div class="panel-heading my-account-title">
                                                <h4 class="panel-title"><a data-bs-toggle="collapse"
                                                        href="#my-account-3">Cash on delivery</a></h4>
                                            </div>
                                            <div id="my-account-3" class="panel-collapse collapse show"
                                                data-bs-parent="#faq">
                                                <div class="panel-body">
                                                    <p><input type="radio" id="payment_method" value="cash on delivery" name="payment_method">
                                                        <label for="payment_method">cash on delivery</label>
                                                    </p>
                                                    <p>
                                                        @error('payment_method')
                                                            <div class='alert text-warning'>{{$message}}<span class="text-white">*</span></div>
                                                        @enderror
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Place-order mt-25">
                            <button type="submit" class="btn-hover d-block">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- checkout area end -->
    </form>
@endsection