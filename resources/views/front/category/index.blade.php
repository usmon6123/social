@extends('layouts.app')
@section('content')

    <div class=" bg-gray-100">
        <div class="flex p-9">
            <div class="w-8/12 mr-12">

                <div
                    class=" mb-3 text-center border-2 rounded-md bg-blue-300 border-t border-b border-blue-500 text-black p-1 font-bold"
                    role="alert">
                    <p class="text-2xl">{{$info->name}}</p>
                </div>

                <ul>
                    @foreach($data as $v)
                        <li class="media flex rounded-md">
                            <img class=" mt-3 mr-3 h-10 w-10 rounded-full  "
                                 src="{{\App\Models\User::getPhoto($v->user_id)}}"
                                 alt="rasim qo'q"/>
                            <div class="media-body">
                                <a href="{{route('view',['selflink'=>$v['self_link'], 'id'=>$v['id'] ])}}"><b
                                        class="text-blue-700">{{$v->title}}</b></a>
                                &emsp; {{\App\Helper\mHelper::time_ago($v->updated_at)}}
                                <br>

                                {{\App\Helper\mHelper::split($v->text,120)}}

                                <div>
                                    <a href="#"
                                       class="text-blue-500">{{\App\Models\Comments::where('question_id',$v->id)->count()}}
                                        Yorum</a> |
                                    <a href="#" class="text-blue-500">{{\App\Models\Visitor::getCount($v->id)}} Goruntulenme</a> |
                                    <a href="{{route('view',['selflink'=>$v['self_link'], 'id'=>$v['id'] ])}}"
                                       class="text-blue-500">Devamini oku</a>
                                </div>

                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-12 col-md-auto align-content-center">
                    {{$data->links()}}
                </div>
            </div>

            <div class="w-4/12 border">
                <div class="list-group">
                    <ul class="border border-gray-200 rounded overflow-hidden shadow-md">
                        @foreach(\App\Models\Category::all() as $category)
                            <li class="flex justify-between px-4 p-2 align-middle bg-white hover:bg-sky-100 hover:text-sky-900 border-b last:border-none border-gray-200 transition-all duration-300 ease-in-out">
                                <a href="{{ route('category.index',['selflink'=>$category->id]) }}">{{$category->name}}</a>
                                <span
                                    class="inline-block bg-blue-500 text-white px-2 py-1 rounded-full ">{{\App\Models\CategoryQuestions::getCountCategory($category->id)}}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
