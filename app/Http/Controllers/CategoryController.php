<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.index',[
            'categories' => Category::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'category_name' => ['required','min:3','unique:categories'],
        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name)));
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->slug = $slug;
        $category->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
        Category::onlyTrashed()->findOrFail($category->id)->restore();
        return back()->with('success','Category Restored Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.category.edit',[
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => ['required','min:3','unique:categories'],
        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name)));
 
        $category->category_name = $request->category_name;
        $category->slug = $slug;
        $category->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','Category Trashed Successfully');
    }

    public function categorytrashed(){
        return view('backend.category.trashed',[
            'categories' => Category::onlyTrashed()->paginate(15),
        ]);
    }

    public function recovertrashed($id){
        Category::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','Category Restored Successfully');
    }
}
