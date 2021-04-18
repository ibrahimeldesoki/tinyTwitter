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
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate')->middleware('throttle:5,30');

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/user', 'UserController@getAuthenticatedUser');
    Route::put('/user', 'UserController@update');

    Route::post('/tweet', 'TweetController@store');
    Route::put('/tweet/{id}', 'TweetController@update');
    Route::delete('/tweet/{id}','TweetController@delete');
    Route::post('/follow', 'FollowController@follow');
    Route::post('/unfollow', 'FollowController@unfollow');

    Route::get('/report', 'UserController@report');
});
