<?php

namespace App\Repositories;

use App\Models\Questions;

class QuestionRepository
{

    public function paginateQuestions(int $page)
    {
        $question = ['id','title','text','updated_at'];
        return Questions::select($question)->orderByDesc('updated_at')->paginate($page);
    }

}
