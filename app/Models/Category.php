<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name, selfLink'];

    static function  getCategoriesName($questionId){
//        $data = Questions::leftJoin('categories_questions','questions.id','=','question_id');

        $r = ['id','name'];

        return    Category::leftJoin('categories_questions as cq','categories.id','=','cq.category_id')
            ->where('cq.question_id',$questionId)
            ->select('categories.id','categories.name')->get();
    }

}
