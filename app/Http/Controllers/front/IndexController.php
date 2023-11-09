<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
//        dd("Bismillah");
        return view('front.index');
    }
}
