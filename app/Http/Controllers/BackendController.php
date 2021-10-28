<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class BackendController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    function backend(){
        if(auth()->user()->roles->first()->name != 'customer'){
            return view('backend.dashboard');
        }
        else{
            return redirect('my-account');
        }
    }
}
