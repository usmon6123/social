@extends('layouts.app')
@section('content')
    <div class=" bg-gray-100">
        <div class="flex p-9">
            <div class="w-8/12 mr-12">
                <li class="media flex ">
                    <img class=" mt-3 mr-3 h-10 w-10 rounded-full  "
                         src="/img.png"
                         alt="rasim qo'q"/>
                    <div class="media-body">
                        <b class="text-blue-700">{{$data->title}}</b>
                        &emsp; {{\App\Helper\mHelper::time_ago($data->updated_at)}}
                        <br>
                        {{$data->text}}
                        <div>
                            <a href="#"
                               class="text-blue-500">{{\App\Models\Comments::where('question_id',$data->id)->count()}}
                                Yorum</a>
                            |<a href="#" class="text-blue-500">{{\App\Models\Visitor::getCount($data->id)}} Goruntulenme</a>
                                @if(auth()->user()->id == $data->user_id)
                                    |<a href="#" class="text-blue-500">Duzenle</a>
                                    |<a href="#" class="text-blue-500">Sil</a>
                                @endif
                        </div>
                    </div>
                </li>

                <div
                    class="mt-3 border-2 rounded-md bg-blue-200 border-t border-b border-blue-500 text-black px-4 py-3 font-bold"
                    role="alert">
                    @if(\App\Models\Comments::where('question_id',$data->id)->count() == 0)
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
                                    <b class="text-black "> {{\App\Helper\mHelper::time_ago($comment->created_at)}}</b>
                                    <b class="text-blue-800  ">&emsp; {{\App\Models\User::getName($comment->user_id)}}</b>
                                    @if($comment->is_correct == 1)
                                        &emsp;<p class="text-green-400 border-2 border-dotted border-green-500 px-2 font-bold">To'g'ri javob</p>
                                    @endif
                                </div>
                                <p class="">{{$comment->text}}</p>
                            </div>
                            <div class="px-4 pb-2 bg-gray-300 rounded-bl-2xl">
                                @if($comment->user_id == auth()->user()->id)
                                <a class=" text-blue-600 " href="{{route('comment.delete',['id'=>$comment->id])}}">sil |</a>
                                @endif
                                <a class=" text-blue-600 " href="{{route('comment.likeOrDislike',['id'=>$comment->id])}}">begen ({{\App\Models\LikeComment::getLike($comment->id)}})</a>

                                @if(auth()->user()->id == $data->user_id and auth()->user()->id ==  $comment->user_id  and \App\Models\Comments::isCorrect($comment->id))
                                    |  <a href="{{route('comment.correct',['commentId'=>$comment->id])}}" class=" text-blue-600">Bu javob to'g'ri </a>
                                @endif

                            </div>
                        </div>

                        <img src="/img-girl-1.jpg" class="mt-3 mr-3 ml-2 object-cover h-10 w-10 rounded-full"
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
