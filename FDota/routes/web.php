<?php

Auth::routes();
Route::post('/register', 'Auth\RegisterController@postCreate');
Route::get('/register/verify/{token}', 'Auth\RegisterController@verify');

Route::group(['namespace' => 'Blog', 'prefix' => config('blog.version'), 'middleware' => 'auth'], function() {
    Route::group(['namespace' => 'Home'], function() {
        Route::post('/post/{post_id}', 'IndexController@createComment');
    });

    Route::group(['namespace' => 'Admin'], function() {
        Route::post('/article/create', 'ArticleController@store');
    });
});

Route::get('/check-login', function () {
    return Auth::check() ? Auth::user() : 0;
});

Route::get('/ljg', function () {
    return view('lijinguang.info');
});

Route::get('{path?}', function () {
    return view('layouts.blog');
})->where('path', '[\/\w\.-]*');
