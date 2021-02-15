<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'App\Http\Controllers\PostsController@index');
Route::get('/popularPosts', 'App\Http\Controllers\PostsController@getPopularPosts');
Route::get('/posts/{id}', 'App\Http\Controllers\PostsController@show');
Route::put('/posts/{id}', 'App\Http\Controllers\PostsController@updatePopularity');
Route::post('/posts', 'App\Http\Controllers\PostsController@store');

Route::get('/rating', 'App\Http\Controllers\RatingController@index');
Route::post('/rating', 'App\Http\Controllers\RatingController@store');

Route::get('/comments', 'App\Http\Controllers\CommentController@index');
Route::get('/comments/{id}', 'App\Http\Controllers\CommentController@show');
Route::post('/comments', 'App\Http\Controllers\CommentController@store');