<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" type="text/css" href="../../css/m.css"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>


    @vite(['resources/css/app.css','resources/css/m.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<div class="pb-1 bg-white dark:bg-gray-900">

    <h2 class="p-6 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Savol javob') }}
    </h2>
    <button class=" bg-blue-200 ">ewe</button>
    {{--    @if (Route::has('login'))--}}
    {{--        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">--}}
    {{--            @auth--}}
    {{--               <a href="{{ url('/dashboard') }}"--}}
    {{--                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">--}}
    {{--                    {!!@auth()->user()->first_name!!}--}}
    {{--                </a>--}}

    {{--                <a  href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">--}}
    {{--                    {{ auth()->user()->first_name }}--}}
    {{--                </a>--}}
    {{--            @endauth--}}
    {{--            @else--}}

    {{--                <a href="{{ route('login') }}"--}}
    {{--                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login</a>--}}

    {{--                @if (Route::has('register'))--}}
    {{--                    <a href="{{ route('register') }}"--}}
    {{--                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>--}}
    {{--                @endif--}}
    {{--        </div>--}}
    {{--    @endif--}}
</div>
<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
    @if (Route::has('login'))
        @if(@auth()->user()->id !== null)
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div
                                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ Auth::user()->first_name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        @else
            <a href="{{ route('login') }}"
               class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login</a>

            <a href="{{ route('register') }}"
               class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
        @endif
    @endif
</div>


@auth()
    <div class="control--menu">
        <div class="container">
            <a href="{{ route('questioncreate') }}">+Yangi savol so'rang</a>
        </div>

    </div>
@endauth


<div class=" bg-gray-100">
    <div class="flex p-9">
        <div class="w-8/12 mr-12">
            {{--            @dd($data->items())--}}
            <ul>
                @foreach($data as $v)
                    {{--                    @dd($data)--}}
                    <li class="media flex ">
                        <img class=" mt-3 mr-3 h-10 w-10 rounded-full  "
                             src="/img.png"
                             alt="rasim qo'q"/>
                        <div class="media-body">
                            <a href="#"><b class="text-blue-700">{{$v->title}}</b></a> &emsp;  {{\App\Helper\mHelper::time_ago($v->updated_at)}}
                            <br>

                            {{\App\Helper\mHelper::split($v->text,120)}}

                            <div>
                                <a href="#" class="text-blue-500">1 Yorum</a> | <a href="#" class="text-blue-500">101 Goruntulenme</a> | <a href="#" class="text-blue-500">devamini oku</a>
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
                        <a href="#">{{$category->name}}</a>  <span class="inline-block bg-blue-500 text-white px-2 py-1 rounded-full ">{{\App\Models\CategoryQuestions::getCountCategory($category->id)}}</span> </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>




