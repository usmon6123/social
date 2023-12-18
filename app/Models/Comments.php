<?php

namespace App\Models;

use App\Helper\mHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\isNull;

class Comments extends Model
{
    use HasFactory;

    protected $guarded = [];

    static function isCorrect($id){
    return Comments::where(['id'=>$id,'is_correct' => 1])->count() == 0;
    }
    static function getLastComment($questionId){
        $comment = Comments::join('users', 'users.id', '=', 'comments.user_id')
            ->where('comments.question_id', $questionId)
            ->select('users.first_name as name', 'comments.created_at as date')
            ->orderByDesc('comments.created_at')
            ->first();
            if(isset($comment)) {
                return $comment['name'] . ' ' . mHelper::time_ago($comment['date']) . ' ' . 'javob berdi';
            }else return "";
    }

}
