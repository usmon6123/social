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
}
