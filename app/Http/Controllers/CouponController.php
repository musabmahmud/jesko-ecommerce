<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.coupon.index',[
            'coupons' => coupon::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coupon.create');
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
            'coupon_name' => ['required','min:3','unique:coupons'],
            'coupon_validity' => ['required'],
            'coupon_limit' => 'integer|min:1|max:100',
            'coupon_percentage' => 'integer|min:1|max:100',
        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->coupon_name)));
        $coupon = new coupon;
        $coupon->coupon_name = $request->coupon_name;
        $coupon->slug = $slug;
        $coupon->coupon_limit = $request->coupon_limit;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->coupon_percentage = $request->coupon_percentage;
        $coupon->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(coupon $coupon)
    {
        return view('backend.coupon.edit',[
            'coupon' => $coupon,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coupon $coupon)
    {
        $request->validate([
            'coupon_name' => ['unique:coupons,coupon_name,'.$coupon->id],
            'coupon_validity' => ['required'],
            'coupon_limit' => 'integer|min:1|max:100',
            'coupon_percentage' => 'integer|min:1|max:100',
        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->coupon_name)));

        $coupon->coupon_name = $request->coupon_name;
        $coupon->slug = $slug;
        $coupon->coupon_limit = $request->coupon_limit;
        $coupon->coupon_validity = $request->coupon_validity;
        $coupon->coupon_percentage = $request->coupon_percentage;
        $coupon->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(coupon $coupon)
    {
        $coupon->delete();
        return back()->with('success','coupon Trashed Successfully');
    }
}
