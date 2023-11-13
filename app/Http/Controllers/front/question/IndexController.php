<?php

namespace App\Http\Controllers\front\question;

use App\Helper\mHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryQuestions;
use App\Models\Questions;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('front.question.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'text' => 'required',
            'tags' => 'required',
        ]);
        $all = $request->except('_token');
        $all['user_id'] = auth()->user()->id;
        $categories = $all['category'];
        unset($all['category']);

        $tags = explode(' ', $all['tags']);
        unset($all['tags']);
//        dd($all);
        $all['self_link'] = mHelper::permalink($all['title']);

        $question = Questions::create([
            'user_id' => $all['user_id'],
            'title' => $all['title'],
            'self_link' => $all['self_link'],
            'text' => $all['text']
        ]);

        if ($question) {
            foreach ($categories as $category) {
                CategoryQuestions::create([
                    'category_id' => $category,
                    'question_id' => $question->id,
                ]);
            };
            foreach ($tags as $tag) {
                CategoryQuestions::create([
                    'question_id' => $question->id,
                    'name' => $tag,
                    'self_link' => mHelper::permalink($tag)
                ]);
            }
        }
        return redirect()->back()->with('status', 'Savol qabul qilindi');
    }
}
