<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Questions;
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

//        $allTags = QuestionsTags::orderBy('question_id')->all();
        return view('front.index')->with('data', $data);
    }

    public function store(Request $request)
    {
        dd($request->except('_token'));
    }

    public function logout()
    {
        return view('front.index');
    }

    public function view($id, $selflink)
    {
        $h = Questions::where('id', $id)->count();
        if ($h != 0) {
            $data = Questions::where('id', $id)->first();
            $comments = Comments::where('question_id',$id)->orderByDesc('created_at')->get();
        } else {
            abort(403);
        }

        return view('front.question.view', ['data' => $data, 'comments'=>$comments]);
    }
}
