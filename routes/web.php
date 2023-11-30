<?php

use App\Http\Controllers\front\category\IndexController as CategoryIndexController;
use App\Http\Controllers\front\comment\IndexController as CommentIndexController;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\front\question\IndexController as questionIndexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//
//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['namespace' => 'front'], function () {
    Route::get("/", [IndexController::class, 'index'])->name('index');
    Route::get("/logout", [IndexController::class, 'logout'])->name('logout');
    Route::get("/view/{id}/{selflink}", [IndexController::class, 'view'])->name('view')->middleware(['visitorUser','auth']);

    Route::group(['namespace' => 'question', 'as' => 'question.', 'prefix' => 'question'], function () {
        Route::get('/create', [questionIndexController::class, 'create'])->name('create');
        Route::post('/store', [questionIndexController::class, 'store'])->name('store');
    })->middleware(['auth']);;
    Route::group(['namespace' => 'comment', 'as' => 'comment.', 'prefix' => 'comment'],function (){
       Route::post('/store/{id}',[CommentIndexController::class, 'store'])->name('store');
        Route::get('/like/{id}',[CommentIndexController::class,'likeOrDisLike'])->name('likeOrDislike');
    })->middleware(['auth']);
    Route::group(['namespace' => 'category', 'as' => 'category.', 'prefix' => 'category'],function (){
        Route::get('/{selflink}',[CategoryIndexController::class, 'index'])->name('index');
    });
});


require __DIR__ . '/auth.php';


