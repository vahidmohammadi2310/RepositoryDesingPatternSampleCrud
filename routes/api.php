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

Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::group(['middleware'=>'auth:api'],function (){

    Route::post('/post/create', 'App\Http\Controllers\PostController@newPost');
    Route::get('/posts', 'App\Http\Controllers\PostController@allPosts');
    Route::patch('/post/{id}/edit', 'App\Http\Controllers\PostController@editPost');
    Route::delete('/post/{id}/delete', 'App\Http\Controllers\PostController@deletePost');


    Route::patch('/permission/{id}/edit', 'App\Http\Controllers\PermissionController@UpdateUserPermission');

});
