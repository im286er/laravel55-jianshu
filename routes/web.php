<?php

Route::get('posts', 'PostsController@index');
Route::get('posts/{post}', 'PostsController@show');
Route::get('posts/create', 'PostsController@create');
Route::post('posts', 'PostsController@store');
Route::get('posts/{post}/edit', 'PostsController@edit');
Route::put('posts/{post}', 'PostsController@update');
Route::get('posts/{post}/delete', 'PostsController@destroy');