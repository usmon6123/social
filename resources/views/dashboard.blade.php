@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Savol javob') }}
        </h2>
    </x-slot>

    @auth()
        <div class="control--menu">
            <div class="container">
                <a href="{{ route('question.create') }}">+Yangi savol so'rang</a>
            </div>

        </div>
    @endauth

        <div class=" bg-white">
            <div class="flex p-9">
                <div class="w-8/12 ">
                    Burasi soru alani
                </div>
                <div class="w-4/12 border">
                    Burasi cevap alani
                </div>
            </div>
        </div>
@endsection

