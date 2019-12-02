<?php

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('category/{category}/show', 'CategoryController@show')->name('category.show');

    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', 'CourseController@index')->name('course.index');
        Route::get('/{course}/show', 'CourseController@show')->name('course.show');
    });

    Route::get('/subjects/{subject}/show', 'SubjectController@show')->name('subject.show');

    Route::get('/users/{profile}/show', 'UserController@show')->name('user.show');

    Route::group(['prefix' => '/users'], function () {
        Route::post('/{user}/update', 'UserController@update')->name('user.update');
    });
});
