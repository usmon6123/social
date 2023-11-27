<?php

namespace App\Http\Controllers\front\category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Questions;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index($selflink){
        $h = Category::where('id',$selflink)->count();
//        dd($h);
        if ($h != 0){
            $info = Category::where('id',$selflink)->get();
            $data = Questions::leftJoin('categories_questions','questions.id','=','question_id')
                ->where('categories_questions.category_id','=',$info[0]['id'])
                ->select('questions.*')
                ->orderByDesc('questions.id')
                ->paginate(10);

            return view('front.category.index')->with('info',$info)->with('data',$data);
        }
        return redirect()->back();
    }
}
