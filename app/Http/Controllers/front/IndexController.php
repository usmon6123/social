<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Questions;
use App\Models\QuestionsTags;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct(
        protected QuestionRepository $questionRepository,
    )
    {
    }

    public function index()
    {
//        dd("Bismillah");
        $data = $this->questionRepository->paginateQuestions(10);

//        $data = Questions::orderByDesc('updated_at')->paginate(10);

//        $allTags = QuestionsTags::orderBy('question_id')->all();
        return view('front.index')->with('data',$data);
    }
    public function store(Request $request){
        dd($request->except('_token'));
    }

    public function logout(){
        return view('front.index');
    }

    public function view($id, $selflink){
        $h = Questions::where('id',$id)->count();
        if ($h != 0){
            $data =  Questions::where('id',$id)->first();
        }

        return view('front.question.view',['data'=>$data]);
    }
}
