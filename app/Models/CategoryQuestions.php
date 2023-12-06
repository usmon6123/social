<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryQuestions extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'question_id'];
    protected $guarded = [];
    protected $table = 'categories_questions';

    static function getCountCategory($categoryId)
    {
        return CategoryQuestions::where('category_id', $categoryId)->count();
    }

    static function getChecked($categoryId, $questionId):bool
    {
        $c = CategoryQuestions::where('category_id', $categoryId)->where('question_id' , $questionId)->count();
        return $c != 0;
    }

}
