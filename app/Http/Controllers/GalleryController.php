<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function galleryIndex($id)
    {
        $galleries = gallery::where('product_id',$id)->latest()->paginate(10);
        $product = Product::findOrFail($id);
        return view('backend.gallery.index', compact('galleries','product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

    }

    public function galleryCreate($id)
    {
        return view('backend.gallery.create',compact('id'));
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
            'gallery_name' => ['required'],
        ]);

        if ($request->hasFile('gallery_name')) {
            $gallery = new Gallery;
            $image = $request->file('gallery_name');
            $ext = Str::random(25) . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('products/'. $ext), 72);
            $gallery->gallery_name = $ext;
            $gallery->product_id = $request->product_id;
            $gallery->save();
            return back()->with('success', 'Gallery Image Successfully Inserted.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(gallery $gallery)
    {
        $id = $gallery->product_id;
        return view('backend.gallery.edit',compact('gallery','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gallery $gallery)
    {
        $request->validate([
            'gallery_name' => ['required'],
        ]);

        if ($request->hasFile('gallery_name')) {
            $image = $request->file('gallery_name');
            $ext = Str::random(25) . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('products/'. $ext), 72);
            $gallery->gallery_name = $ext;
            $gallery->save();
            return back()->with('success', 'Gallery Image Successfully Inserted.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(gallery $gallery)
    {
        $gallery->delete();
        return back()->with('success','Gallery Delete Successfully');
    }
}
