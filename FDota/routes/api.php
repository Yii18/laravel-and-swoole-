<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['namespace' => 'Blog\Home'], function() {
    Route::get('/study/{num}', 'StudyController@paginateData')->name('ApiStudy');
});

Route::group(['namespace' => 'Blog'], function() {
        require base_path("routes/api/blog.php");
});
