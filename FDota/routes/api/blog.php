<?php

Route::group(['namespace' => 'Home'], function() {

    Route::get('/getAuthUserInfo', 'IndexController@getAuthUserInfo');

    Route::get('/post', 'IndexController@list');

    Route::get('/rside', 'IndexController@rside');

    // Route::get('/dotaMax', 'IndexController@dotaMax')->name('blogHomeDotaMax');

    Route::get('/post/{post_id}', 'IndexController@show');

    Route::get('/post/comment/{post_id}', 'IndexController@showComment');

    Route::get('/post/markdown/{post_id}', 'IndexController@showMarkdown');

    Route::get('/user/{uid}', 'IndexController@showUserPostList');

    Route::get('/tags/{tid}', 'IndexController@showTagPostList');

//    Route::get('/study', 'StudyController@index')->name('blogHomeStudy');
});

//Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function() {
//    // Users
//    Route::get('/users/list', 'UsersController@list')->name('blogAdminUserList');
//
//    // Study
//    Route::get('/study/list', 'StudyController@index')->name('blogAdminStudyList');
//
//    Route::get('/study/create', 'StudyController@create')->name('blogAdminStudyCreate');
//    Route::post('/study/create', 'StudyController@store');
//
//    Route::any('/study/update/{id}', 'StudyController@update');
//    Route::get('/study/update', 'StudyController@update')->name('blogAdminStudyUpdate');
//    // Study tags
//    Route::get('/study/tags/list', 'StudyTagsController@index')->name('blogAdminStudyTagsList');
//
//    Route::get('/study/tags/create', 'StudyTagsController@create')->name('blogAdminStudyTagsCreate');
//    Route::post('/study/tags/create', 'StudyTagsController@store');
//
//    Route::get('/study/tags/update/{id}', 'StudyTagsController@edit');
//    Route::post('/study/tags/update/{id}', 'StudyTagsController@update');
//
//    Route::get('/study/tags/update', 'StudyTagsController@update')->name('blogAdminStudyTagsUpdate');
//
//    // Article
//    Route::get('/article/list', 'ArticleController@index')->name('blogAdminArticleList');
//
//    Route::get('/article/create', 'ArticleController@create')->name('blogAdminArticleCreate');
//    Route::post('/article/create', 'ArticleController@store');
//
//    Route::get('/article/update/{id}', 'ArticleController@edit');
//    Route::post('/article/update/{id}', 'ArticleController@update');
//    Route::get('/article/update', 'ArticleController@update')->name('blogAdminArticleUpdate');
//
//    Route::get('/article/del/{id}', 'ArticleController@destroy');
//    Route::get('/article/del', 'ArticleController@destroy')->name('blogAdminArticleDelete');
//    // Index
//    Route::get('/', 'IndexController@index')->name('blogAdminIndex');
//});
