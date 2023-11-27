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
                            <a href="#" class="text-blue-500">1 Yorum</a> |
                            <a href="#" class="text-blue-500">101 Goruntulenme</a> |
                        </div>

                    </div>
                </li>



                <div class="pb-16">
                    <div class="m-auto mt-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                        @if(session('status'))
                            <div class="p-5">
                                <div
                                    class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-md text-green-700 border border-green-300 ">
                                    <div slot="avatar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-check-circle w-5 h-5 mx-2">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <div class="text-xl font-normal  max-w-full flex-initial">
                                        {{session('status')}}</div>

                                </div>
                            </div>
                        @endif
                        <div class="bg-blue-300  0 p-2 pl-6"><b>Javob yozish!</b></div>
                        <div class="px-6 py-4">
                            <form method="POST" action="{{route('question.store')}}">
                                @csrf
                                <div class="mt-4">
                                    <label>Javobingiz </label><br>
                                    <textarea name="text" rows="10"
                                              class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{old('text')}}</textarea>
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
