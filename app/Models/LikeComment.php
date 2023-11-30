<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
    use HasFactory;
    protected $guarded = [];

    static function getLike($commentId){
        return LikeComment::where('comment_id',$commentId)->count();
    }

}
