<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $guarded = [];

static function isCorrect($id){
    return Comments::where(['id'=>$id,'is_correct' => 1])->count() == 0;


}
}
