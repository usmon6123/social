<?php

namespace App\Http\Middleware;

use App\Models\Questions;
use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitorUser
{

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()){
            //tepadagi linkdan question id ni oladi
            $qId = $request->segment(2);
            if (Questions::where('id',$qId)->count()!=0) {
                if (Visitor::where(['question_id' => $qId, 'user_id' => auth()->user()->id])->count() == 0) {
                    Visitor::create(['user_id' => auth()->user()->id, 'question_id' => $qId]);
                };
            }
        }
        return $next($request);
    }
}
