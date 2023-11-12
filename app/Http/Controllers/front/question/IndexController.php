<?php

namespace App\Http\Controllers\front\question;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function create(){
        $categories = Category::all();
        return view('front.question.create')->with('categories',$categories);
    }
    public function store(Request $request){
        dd($request->except('_token'));
    }
}
