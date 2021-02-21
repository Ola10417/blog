<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');

Route::post('/posts', 'App\Http\Controllers\PostsController@store')->middleware('auth');
Route::delete('/posts/destroy/{id}', 'App\Http\Controllers\PostsController@destroy')->middleware('auth');
Route::put('/posts/{id}', 'App\Http\Controllers\PostsController@update')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
