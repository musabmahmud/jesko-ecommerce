<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.brand.index',[
            'brands' => brand::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
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
            'brand_name' => ['required','min:3','unique:brands'],
        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->brand_name)));
        $brand = new brand;
        $brand->brand_name = $request->brand_name;
        $brand->slug = $slug;
        $brand->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(brand $brand)
    {
        return $brand;
        brand::onlyTrashed()->findOrFail($brand->id)->restore();
        return back()->with('success','brand Restored Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(brand $brand)
    {
        return view('backend.brand.edit',[
            'brand' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, brand $brand)
    {
        $request->validate([
            'brand_name' => ['required','min:3','unique:brands'],
        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->brand_name)));
 
        $brand->brand_name = $request->brand_name;
        $brand->slug = $slug;
        $brand->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(brand $brand)
    {
        $brand->delete();
        return back()->with('success','brand Trashed Successfully');
    }

    public function brandtrashed(){
        return view('backend.brand.trashed',[
            'brands' => brand::onlyTrashed()->paginate(15),
        ]);
    }

    public function brandrecovery($id){
        brand::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','brand Restored Successfully');
    }
}
