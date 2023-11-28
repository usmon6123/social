@extends('layouts.app')
@section('header')
    <script type="module" src="{{asset('main.js')}}"></script>
@endsection
@section('content')
    <div class="pl-16 pr-16 pb-16">
        <div class="m-auto mt-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @if(session('status'))
                <x-alert-success>
                    <x-slot:successMessage>
                        {{session('status')}}
                    </x-slot:successMessage>
                </x-alert-success>
            @endif
            <div class="bg-blue-300  0 p-2 pl-6"><b>Yangi savol so'rang!</b></div>
            <div class="px-6 py-4">
                <form method="POST" action="{{route('question.store')}}">
                    @csrf

                    <div class="mt-4">
                        <label>Soru başlıki(sarlavha|title) </label>
                        <x-text-input type="text" name="title" value="{{old('title')}}" class="block mt-1 w-full" autofocus/>
                        @error('title')
                        <p class="mb-4 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4 ">
                        <label>kategorya tanlang </label><br>
                        <div class="flex flex-wrap  p-2 border-2 rounded-md  mt-1 w-full sm:justify-between">
                            @foreach($categories as $key => $value)
                                <div class="max-w-xs sm:w-6/12 md:w-4/12  m-checkbox ">
                                    <input type="checkbox" name="category[]" value="{{$value['id']}}">
                                    {{$value['name']}}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4">
                        <label>Savolingiz </label><br>
                        <textarea name="text" rows="10"
                                  class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{old('text')}}</textarea>
                        @error('text')
                        <p class="mb-4 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label>etiketler(yorliqlar|tags) </label>
                        <x-text-input type="text" name="tags" value="{{old('tags')}}" id="tokenfield"
                                      class="block mt-1 w-full"
                                      autofocus/>
                        @error('tags')
                        <p class="mb-4 text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-3">
                            Jo'natish
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    {{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
    <script src="refresh-page.js"></script>

@endsection
