<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Gallery;
use App\Models\Attribute;
use App\Models\Color;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        return view('backend.product.index',[
            'products' => Product::latest()->paginate(20),
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
        $colors = Color::orderBy('color_name', 'Asc')->get();
        return view('backend.product.create', compact('categories','brands','colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => ['required', 'min:3', 'unique:products'],

            // 'category_id' => ['required'],
            // 'brand_id' => ['required'],
            // 'thumbnail' => ['required'],

            // 'type_name' => ['nullable'],
            // 'weight' => ['nullable'],
            // 'materials' => ['nullable'],
            // 'short_info' => ['nullable'],

            // 'summary' => ['required'],
            // 'description' => ['required'],
            
            // 'gallery' => ['required'],
            // 'gallery.*' => ['required'],

            // 'color' => ['required'],
            // 'color.*' => ['required'],

            // 'size' => ['required'],
            // 'size.*' => ['required'],

            // 'quantity' => ['required'],
            // 'quantity.*' => ['required'],

            // 'price' => ['required'],
            // 'price.*' => ['required'],

            // 'offer_price' => ['nullable'],
            // 'offer_price.*' => ['nullable'],

        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->product_name)));
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_slug = $slug;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->type_name = $request->type_name;
        $product->weight = $request->weight;
        $product->materials = $request->materials;
        $product->short_info = $request->short_info;
        $product->summary = $request->summary;
        $product->description = $request->description;
        //Thumbnail Inserted
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $ext = Str::random(5) . '-' . $slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('products/'. $ext), 72);
            $product->thumbnail = $ext;
        }
        //Product Saved
        $product->save();
        //gallery Inserted
        if ($request->hasFile('gallery')) {
            $gallery = $request->file('gallery');
            foreach ($gallery as $key => $value) {
                $gallery = new Gallery;
                $extg = Str::random(5) . '-' . $slug . '.' . $value->getClientOriginalExtension();
                Image::make($value)->save(public_path('galleries/'. $extg), 72);
                $gallery->gallery_name = $extg;
                $gallery->product_id = $product->id;
                $gallery->save();
            }
        }
        // //attribute Inserted
        foreach ($request->color_id as $key => $color_id) {
            $attr = new Attribute;
            $attr->product_id = $product->id;
            $attr->color_id = $color_id;
            $attr->size = $request->size[$key];
            $attr->quantity = $request->quantity[$key];
            $attr->price = $request->price[$key];
            $attr->offer_price = $request->offer_price[$key];
            $attr->save();
        }
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
        $attrs = Attribute::where('product_id',$product->id)->latest()->paginate(10);
        $galleries = Gallery::where('product_id',$product->id)->latest()->paginate(10);
        return view('backend.product.show', compact('attrs','galleries','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('category_name', 'Asc')->get();
        $brands = Brand::orderBy('brand_name', 'Asc')->get();
        return view('backend.product.edit', compact('categories','brands','product'));
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
        $request->validate([
            'product_name' => ['unique:products,product_name,'.$product->id],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            
            'type_name' => ['nullable'],
            'weight' => ['nullable'],
            'materials' => ['nullable'],
            'short_info' => ['nullable'],

            'summary' => ['required'],
            'description' => ['required'],

        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->product_name)));
        $product->product_name = $request->product_name;
        $product->product_slug = $slug;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->type_name = $request->type_name;
        $product->weight = $request->weight;
        $product->materials = $request->materials;
        $product->short_info = $request->short_info;
        $product->summary = $request->summary;
        $product->description = $request->description;
        //Thumbnail Inserted
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $image_path = "products/".$product->thumbnail; 
            if (file_exists($image_path)) {
                @unlink($image_path);
            }
            $ext = Str::random(5) . '-' . $slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('products/'. $ext), 72);
            $product->thumbnail = $ext;
            
        }
        //Product Saved
        $product->save();
        return back()->with('success', 'Data Successfully Inserted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success','brand Trashed Successfully');
    }

    public function producttrashed(){
        return view('backend.product.trashed',[
            'products' => Product::onlyTrashed()->paginate(15),
        ]);
    }
    public function productrecovery($id){
        Product::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','Product Restored Successfully');
    }

}
