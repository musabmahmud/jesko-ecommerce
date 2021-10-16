<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return view('backend.type.index',[
            'types' => type::paginate(15),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.type.create');
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
            'type_name' => ['required','min:3','unique:types'],
        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->type_name)));
        $type = new type;
        $type->type_name = $request->type_name;
        $type->slug = $slug;
        $type->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(type $type)
    {
        return $type;
        type::onlyTrashed()->findOrFail($type->id)->restore();
        return back()->with('success','type Restored Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(type $type)
    {
        return view('backend.type.edit',[
            'type' => $type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, type $type)
    {
        $request->validate([
            'type_name' => ['required','min:3','unique:types'],
        ]);
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->type_name)));
 
        $type->type_name = $request->type_name;
        $type->slug = $slug;
        $type->save();

        return back()->with('success','Data Inserted Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(type $type)
    {
        $type->delete();
        return back()->with('success','type Trashed Successfully');
    }

    public function typetrashed(){
        return view('backend.type.trashed',[
            'types' => type::onlyTrashed()->paginate(15),
        ]);
    }

    public function typerecovery($id){
        type::onlyTrashed()->findOrFail($id)->restore();
        return back()->with('success','type Restored Successfully');
    }
}
