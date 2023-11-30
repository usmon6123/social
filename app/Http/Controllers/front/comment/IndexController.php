<?php

namespace App\Http\Controllers\front\comment;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\LikeComment;
use App\Models\Questions;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function store(Request $request ){
        $id = $request->route('id');
        $h = Questions::where('id',$id)->count();
        if ($h!=0){
            $all = $request->except('_token');
            $control = Comments::where('question_id',$id)->count();
            if ($control != 0){
                $wControl = Comments::where('question_id',$id)->orderByDesc('id')->first();
//                dd($wControl);
                if ($wControl['user_id'] == auth()->user()->id){
                    return redirect()->back()->with('status', 'ust usta yorum yapamazsin :@');
                }
            }
            $all['user_id'] = auth()->user()->id;
            $all['question_id'] = $id;
            $create = Comments::create($all);

            if ($create){
                return redirect()->back()->with('status','Yorum basari ile eklendi :)');
            }else{
                return redirect()->back()->with('status','yorum eklenemedi :/');
            }

        }else{
            abort(404);
        }
//        dd($request->id);

        return redirect()->refresh();
    }

    public function likeOrDisLike($commentId){
        if (Comments::where('id',$commentId)->count() != 0){

            //kirgan User o'zining javobiga like bosolmaydi
            $c = Comments::where('id',$commentId)->first();
            if ($c->user_id == auth()->user()->id){
                return redirect()->back();
            }

            $w = LikeComment::where('user_id',auth()->user()->id)->where('comment_id',$commentId)->count();
            if ($w==0){
                LikeComment::create(['user_id' => auth()->user()->id,'comment_id' => $commentId ]);
            }else{
                LikeComment::where('user_id',auth()->user()->id)->where('comment_id',$commentId)->delete();
            }
            return redirect()->back();
        }

    }
}
