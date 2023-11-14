<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryQuestions extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','question_id'];
    protected $guarded = [];
    protected $table = 'categories_questions';

}
