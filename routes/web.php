<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register'=> false] );


Route::middleware('auth')->group(function(){

    Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home');

    Route::resource('post', App\Http\Controllers\PostController::class);
    Route::post('post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');

    Route::resource('comment', App\Http\Controllers\CommentController::class);
    Route::post('comment/create/{id_post}', [App\Http\Controllers\CommentController::class, 'create'])->name('comment.create');

    Route::get('profile/{id_user}', [App\Http\Controllers\PostController::class, 'profile'])->name('user.profile');

});

Route::get('/auth/redirect', [App\Http\Controllers\Auth\LoginController::class , 'loginGoogle'])->name('loginGoogle');
Route::get('/auth/callback', [App\Http\Controllers\Auth\LoginController::class , 'loginCallback'])->name('loginCallback');





