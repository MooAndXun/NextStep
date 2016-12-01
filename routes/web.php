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

Route::get("/", function () {
    return view('welcome');
});

Route::group(['prefix'=>'login'], function () {
    Route::get('/{error?}/{type?}', function () {
        return view('pages.login');
    });
});

Route::group(['prefix'=>'register'], function () {
    Route::get('/{error?}/{type?}', function () {
        return view('pages.register');
    });
});

// User Routes
Route::group(['prefix'=>'user'], function () {
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
    Route::post('info','UserController@updateUserInfo');
    Route::get('info','UserController@getUserInfo');
});

//Follow Routes
Route::group(['prefix'=>'follow'],function (){
    Route::get('','FollowController@friends_page');
});

// Home Routes
Route::group(["prefix"=>'home'], function () {
    Route::get('/', 'HomeController@today_page')->middleware("login_check");
    Route::get('today', 'HomeController@today_page')->middleware("login_check");
    Route::get('stat', 'HomeController@stat_page')->middleware("login_check");
});

// Activity Routes
Route::group(["prefix"=>'activity'], function () {
    Route::get('/', 'ActivityController@activity_page')->middleware("login_check");
    Route::get('{id}', 'ActivityController@activity_detail_page')->where('id', '[0-9]+');

    Route::get('join', 'ActivityController@join');
    Route::post('/','ActivityController@create')->middleware("login_check");
    Route::delete('/','ActivityController@delete');
    Route::post('/update','ActivityController@update')->middleware("login_check");
});

// Circle Routes
Route::group(['prefix'=>'circle'], function () {
    Route::get('/', 'CircleController@circle_page');
    Route::get('/{id}', 'CircleController@circle_detail_page')->where('id', '[0-9]+');

    Route::get('join', 'CircleController@join');
    Route::post('/','CircleController@create')->middleware("login_check");
    Route::delete('/','CircleController@delete');
    Route::post('/update','CircleController@update')->middleware("login_check");
});

// Permission Routes
Route::group(['prefix'=>'permission'], function () {
    Route::get('/', 'PermissionController@permission_manage_page');
    Route::get('management', 'PermissionController@permission_manage_page');
});
