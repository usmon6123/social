@php use App\Models\Visitor; @endphp
@php use App\Helper\mHelper; @endphp
@php use App\Models\LikeComment; @endphp
@php use App\Models\Comments; @endphp
@php use App\Models\User; @endphp
@php use App\Models\Category; @endphp
@php use App\Models\CategoryQuestions; @endphp
@extends('layouts.app')
@section('content')
    <div class=" bg-gray-100">
        <div class="flex p-9">
            <div class="w-8/12 mr-12">
                <b class="text-xl">Eng so'ng so'ralgan savollar</b>
                <li class="media flex ">
                    {{--                    mt-3 mr-3 ml-2 object-cover h-10 w-10 rounded-full--}}
                    <img class=" mt-3 mr-3 h-10 w-10 rounded-full object-cover  "
                         src="{{User::getPhoto($data->user_id)}}"
                         alt="rasim qo'q"/>
                    <div class="media-body">
                        <div class="flex">
                        <b class="text-blue-700">{{$data->title}}</b>
                            @php $c = \App\Models\Category::getCategoriesName($data->id) @endphp
                            @foreach($c as $item)
                                <div class="blue-button">
                                    <a href="{{ route('category.index',['selflink'=>$item->id]) }}">{{$item->name}}</a>
                                </div>
                            @endforeach
                        </div>
                        <p class="mt-2">&emsp;{{$data->text}}</p>
                        <div class="mt-2 border-t-2 border-t-black p-1">
                            <a href="#"
                               class="text-blue-950">{{Comments::where('question_id',$data->id)->count()}}
                                Yorum</a>
                             - <a href="#" class="text-blue-950">{{Visitor::getCount($data->id)}}
                                Goruntulenme</a>
                             - <a href="#" class="text-blue-950">{{mHelper::time_ago($data->created_at)}}</a>
                            @if(auth()->user()->id == $data->user_id)
                                 - <a href="{{route('question.edit',['id'=>$data->id])}}"
                                    class="text-blue-950">Duzenle</a>
                                 - <a href="{{route('question.delete',['id'=>$data->id])}}" class="text-blue-950">Sil</a>
                            @endif
                        </div>
                    </div>
                </li>
                <div class="media">
                    @php $t = \App\Models\QuestionsTags::getTags($data->id) @endphp
                    <b class=" rounded-md mr-1 px-1 text-black">Taglar:</b>
                    @foreach($t as $item)
                        <a class="bg-blue-300 rounded mr-1 px-1 text-black"><b>{{$item->name}}</b></a>
                    @endforeach
                </div>

                <div
                    class="mt-3 border-2 rounded-md bg-green-600 border-t border-b border-blue-500 text-black px-4 py-3 font-bold text-center"
                    role="alert">
                    @if(Comments::where('question_id',$data->id)->count() == 0)
                        <p class="">Hali javob berilmagan, ilk javobni sen yozishing mumkin</p>
                    @else
                        <p class="">Jovoblar</p>
                    @endif
                </div>

                @foreach($comments as $comment)
                    <div class="flex justify-end mb-4 mt-4">
                        <div class="bg-white border-2  rounded-bl-2xl rounded-tl-2xl rounded-tr-xl">
                            <div class="mr-2 py-3 px-4 pb-1 text-black">
                                <div class="flex justify-between">
                                    <b class="text-black "> {{mHelper::time_ago($comment->created_at)}}</b>
                                    <b class="text-blue-800  ">&emsp; {{User::getName($comment->user_id)}}</b>
                                    @if($comment->is_correct == 1)
                                        &emsp;<p
                                        class="text-green-400 border-2 border-dotted border-green-500 px-2 font-bold">
                                        To'g'ri javob</p>
                                    @endif
                                </div>
                                <p class="">{{$comment->text}}</p>
                            </div>
                            <div class="px-4 pb-2 bg-gray-300 rounded-bl-2xl">
                                @if($comment->user_id == auth()->user()->id)
                                    <a class=" text-blue-600 " href="{{route('comment.delete',['id'=>$comment->id])}}">sil
                                        |</a>
                                @endif
                                <a class=" text-blue-600 "
                                   href="{{route('comment.likeOrDislike',['id'=>$comment->id])}}">begen
                                    ({{LikeComment::getLike($comment->id)}})</a>

                                    @if(auth()->user()->id == $data->user_id and auth()->user()->id ==  $comment->user_id  and Comments::isCorrect($comment->id))
                                    |  <a href="{{route('comment.correct',['commentId'=>$comment->id])}}"
                                          class=" text-blue-600">Bu javob to'g'ri </a>
                                @endif

                            </div>
                        </div>

                        <img src="{{User::getPhoto($comment->user_id)}}"
                             class="mt-3 mr-3 ml-2 object-cover h-10 w-10 rounded-full"
                             alt="no photo"/>
                    </div>
                @endforeach

                {{--                javob yozadigan qism--}}
                <div class="pb-16">
                    <div class="m-auto mt-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                        @if(session('status'))
                            <x-alert-success>
                                <x-slot:successMessage>
                                    {{session('status')}}
                                </x-slot:successMessage>
                            </x-alert-success>
                        @endif
                        <div class="bg-blue-300  0 p-2 pl-6"><b>Javob yozish!</b></div>
                        <div class="px-6 py-4">
                            <form method="POST" action="{{route('comment.store',['id'=>$data->id])}}">
                                @csrf
                                <div class="mt-4">
                                    <label>Javobingiz </label><br>
                                    <textarea name="text" rows="10"
                                              class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                              required>{{old('text')}}</textarea>
                                    @error('text')
                                    <p class="mb-4 text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="ms-3">
                                        Javob berish
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{--        Kategoriya qismi--}}
            <div class="w-4/12 ">
                <b class="text-xl">Kategoriyalar</b>

                <div class="list-group">
                    @if(Category::all()->count() != 0)
                        <ul class="border border-gray-200 rounded overflow-hidden shadow-md">
                            @foreach(Category::all() as $category)
                                <li class="flex justify-between px-4 p-2 align-middle bg-white hover:bg-sky-100 hover:text-sky-900 border-b last:border-none border-gray-200 transition-all duration-300 ease-in-out">
                                    <a href="{{ route('category.index',['selflink'=>$category->id]) }}">{{$category->name}}</a>
                                    <span
                                        class="inline-block bg-blue-500 text-white px-2 py-1 rounded-full ">{{CategoryQuestions::getCountCategory($category->id)}}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div
                            class="mt-3 border-2 rounded-md bg-blue-100 border-t border-b border-blue-500 text-black px-4 py-3 font-bold"
                            role="alert">
                            <p class="">Bu kategoriya uchun savol so'ralmagan hali</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
