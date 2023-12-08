<?php

namespace App\Repositories;

use App\Models\Questions;

class QuestionRepository
{

    public function paginateQuestions(int $page)
    {
//        $question = ['id','user_id','title','self_link','text','','updated_at'];
        return Questions::orderByDesc('created_at')->paginate($page);
    }

}
