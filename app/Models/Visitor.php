<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $guarded = [];


    static function getCount($questionId)
    {
        return Visitor::where('question_id', $questionId)->count();
    }
}


