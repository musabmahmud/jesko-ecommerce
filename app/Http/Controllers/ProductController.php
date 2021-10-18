<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Gallery;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.product.index',[
            'products' => Product::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_name', 'Asc')->get();
        $brands = Brand::orderBy('brand_name', 'Asc')->get();
        return view('backend.product.create', compact('categories','brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => ['required', 'min:3'],
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gallery' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gallery.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'color' => ['required'],
            'color.*' => ['required'],
            'size' => ['required'],
            'size.*' => ['required'],
            'quantity' => ['required'],
            'quantity.*' => ['required'],
            'price' => ['required'],
            'price.*' => ['required'],
            'summary' => ['required'],
            'description' => ['required'],
        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->product_name)));
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_slug = $slug;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->weight = $request->weight;
        $product->materials = $request->materials;
        $product->short_info = $request->short_info;
        $product->summary = $request->summary;
        $product->description = $request->description;
        $product->thumbnail = $slug;
        //Thumbnail Inserted
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $ext = $slug . '-' .Str::random(5).'.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('products/' . $ext), 72);
            $product->thumbnail = $ext;
        }
        //Product Saved
        $product->save();
        //gallery Inserted
        // if ($request->hasFile('gallery')) {
        //     $gallery = $request->file('gallery');
        //     foreach ($gallery as $key => $value) {
        //         $gallery = new Gallery;
        //         $extg = Str::random(5) . '-' . $slug . '.' . $value->getClientOriginalExtension();
        //         Image::make($value)->save(public_path('products/'. $extg), 72);
        //         $gallery->gallery = $extg;
        //         $gallery->product_id = $product->id;
        //         $gallery->save();
        //     }
        // }
        // //attribute Inserted
        // foreach ($request->color as $key => $color) {
        //     $attr = new Attribute;
        //     $attr->product_id = $product->id;
        //     $attr->color = $color;
        //     $attr->size = $request->size[$key];
        //     $attr->quantity = $request->quantity[$key];
        //     $attr->price = $request->price[$key];
        //     $attr->offer_price = $request->offer_price[$key];
        //     $attr->save();
        // }
        return back()->with('success', 'Data Successfully Inserted.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
