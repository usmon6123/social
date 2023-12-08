<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsTags extends Model
{
    use HasFactory;
    protected $fillable = ['question_id','name','self_link'];
//    protected $guarded = [];
    protected $table = 'questions_tags';

    //question id orqali u questionning barcha taglarini string qilib qaytaradi
    static function getImplodeTags($questionId){
        $arr = QuestionsTags::where('question_id',$questionId)->select('name')->get();
        $res = [];
        foreach ($arr as $q){
          $res[] = $q->name;
        }
        return implode(' ',$res);
    }
    //question id orqali u questionning barcha taglarini qaytaradi
    static function getTags($questionId){
        $arr = QuestionsTags::where('question_id',$questionId)->select('name')->get();
        return $arr;
    }
}
