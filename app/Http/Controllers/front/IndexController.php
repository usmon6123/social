<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
//        dd("Bismillah");
        return view('front.index');
    }
    public function store(Request $request){
        dd($request->except('_token'));
    }
}
