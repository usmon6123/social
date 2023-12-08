<?php

namespace App\Http\Controllers\front\question;

use App\Helper\mHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionStoreRequest;
use App\Models\Category;
use App\Models\CategoryQuestions;
use App\Models\Comments;
use App\Models\Questions;
use App\Models\QuestionsTags;
use App\Models\Visitor;
use App\Repositories\QuestionRepository;
use Auth;

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

        return redirect('/')->with('data', $data)->with('status', 'Savol qabul qilindi');
    }

    public function edit($id)
    {
        $c = Questions::where('id', $id)->first();
        if ($c->user_id == Auth::id()) {
//        return redirect("question/edit/$id");
            $categories = Category::all();
            return view('front.question.edit')->with('oldQuestion', $c)->with('categories', $categories);
        }
        return redirect()->back();

    }

    public function update(QuestionStoreRequest $request)
    {
        $id = $request->route('id');
        if (Questions::where('id', $id)->get()->count() != 0) {
            $all = $request->except('_token');
            $all['user_id'] = auth()->user()->id;
            $categories_ids = $all['category'];
            unset($all['category']);

            $tags = explode(' ', $all['tags']);
            unset($all['tags']);
            $all['self_link'] = mHelper::permalink($all['title']);

            $question = Questions::where('id', $id)->update([
                'user_id' => $all['user_id'],
                'title' => $all['title'],
                'self_link' => $all['self_link'],
                'text' => $all['text']
            ]);
            if ($question) {
                CategoryQuestions::where('question_id', $id)->delete();
                foreach ($categories_ids as $category_id) {
                    CategoryQuestions::create([
                        'category_id' => $category_id,
                        'question_id' => $id,
                    ]);
                };
                QuestionsTags::where('question_id', $id)->delete();
                foreach ($tags as $tag) {
                    QuestionsTags::create([
                        'question_id' => $id,
                        'name' => $tag,
                        'self_link' => mHelper::permalink($tag)
                    ]);
                }
            }
        }
        $data = $this->questionRepository->paginateQuestions(10);
        return redirect('/')->with('data', $data)->with('status', $all['title']." sarlavhali savol o'zgartirildi");

    }

    public function delete($id)
    {
        $c = Questions::where('id', $id)->delete();
        if ($c) {
            QuestionsTags::where('question_id', $id)->delete();
            CategoryQuestions::where('question_id', $id)->delete();
            Comments::where('question_id', $id)->delete();
            Visitor::where('question_id', $id)->delete();
        }
        $data = $this->questionRepository->paginateQuestions(10);
        return redirect('/')->with('data', $data)->with('status', "$id - savol o'chirildi");
    }
}
