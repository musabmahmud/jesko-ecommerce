<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function attributeIndex($id)
    {
        $attrs = Attribute::where('product_id',$id)->latest()->paginate(10);
        $product = Product::findOrFail($id);
        return view('backend.attribute.index', compact('attrs','product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

    }

    public function attributeCreate($id)
    {
        return view('backend.attribute.create',compact('id'));
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
            'color' => ['required'],
            'size' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
            'offer_price' => ['nullable']
        ]);

        $attr = new Attribute;
        $attr->product_id = $request->product_id;
        $attr->color = $request->color;
        $attr->size = $request->size;
        $attr->quantity = $request->quantity;
        $attr->price = $request->price;
        $attr->offer_price = $request->offer_price;
        $attr->save();
        return back()->with('success', 'Data Successfully Inserted.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $id =$attribute->product_id;
        return view('backend.attribute.edit',compact('attribute','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'color' => ['required'],
            'size' => ['required'],
            'quantity' => ['required'],
            'price' => ['required'],
            'offer_price' => ['nullable']
        ]);

        $attribute->color = $request->color;
        $attribute->size = $request->size;
        $attribute->quantity = $request->quantity;
        $attribute->price = $request->price;
        $attribute->offer_price = $request->offer_price;
        $attribute->save();
        return back()->with('success', 'Data Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return back()->with('success','Attribute Delete Successfully');
    }
}
