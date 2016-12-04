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

// Activity Routes
Route::group(["prefix" => 'activity'], function () {

});

Route::group(['prefix' => 'health'], function () {
    Route::get('today/{username}', 'HealthController@getTodayHealthData');
    Route::get('stat/step/week/{username}', 'HealthController@getWeekStepStat');
    Route::get('stat/step/day/{username}', 'HealthController@getDayStepStat');
    Route::get('stat/step/month/{username}', 'HealthController@getMonthStepStat');
});

Route::get('/wearable/{start_date}/{date_num}', "WearableController@healthData");