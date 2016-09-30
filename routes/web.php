<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','PagesController@getIndex');
Route::resource('posts', 'PostController');
Route::resource('categories', 'CategoryController');
Route::get('blog/{slug}',['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\_\-]+');
Route::get('blog',['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);