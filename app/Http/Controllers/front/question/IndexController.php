<?php

namespace App\Http\Controllers\front\question;

use App\Helper\mHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Models\Category;
use App\Models\CategoryQuestions;
use App\Models\Questions;
use App\Models\QuestionsTags;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __construct(
        protected QuestionRepository $questionRepository,
    )
    {
    }

    public function create()
    {
        $categories = Category::all();
        return view('front.question.create')->with('categories', $categories);
    }

    public function store(QuestionStoreRequest $request)
    {
        $all = $request->except('_token');
        $all['user_id'] = auth()->user()->id;
        $categories_ids = $all['category'];
        unset($all['category']);

        $tags = explode(' ', $all['tags']);
        unset($all['tags']);
        $all['self_link'] = mHelper::permalink($all['title']);
        $question = Questions::create([
            'user_id' => $all['user_id'],
            'title' => $all['title'],
            'self_link' => $all['self_link'],
            'text' => $all['text']
        ]);
        if ($question) {
            foreach ($categories_ids as $category_id) {
                CategoryQuestions::create([
                    'category_id' => $category_id,
                    'question_id' => $question->id,
                ]);
            };
            foreach ($tags as $tag) {
                QuestionsTags::create([
                    'question_id' => $question->id,
                    'name' => $tag,
                    'self_link' => mHelper::permalink($tag)
                ]);
            }
        }
        $data = $this->questionRepository->paginateQuestions(10);

        return view('front.index')->with('data', $data)->with('status', 'Savol qabul qilindi');
    }
}
