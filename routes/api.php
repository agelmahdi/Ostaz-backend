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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group( ['middleware' => ['cors']], function () {
    Route::post( '/', function () {
          return ['data'=>'Yes'];
        });
});
Route::group( [
    'prefix' => 'follower','middleware' => ['cors']
], function () {
    Route::post( 'login', 'Auth\ApiAuthFollowerController@authenticate' );
    Route::post( 'register', 'Auth\ApiAuthFollowerController@register' );

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post( 'update-profile-image', 'Auth\ApiAuthFollowerController@updateProfileImage' );
        Route::put( 'update-profile', 'Auth\ApiAuthFollowerController@updateProfileImage' );
        Route::put( 'update-profile-password', 'Auth\ApiAuthFollowerController@updateProfilePassword' );
        Route::get( 'me', 'Auth\ApiAuthFollowerController@getAuthenticatedUser' );
    });

} );
Route::group( [
    'prefix' => 'streamer','middleware' => ['cors']
], function () {
    Route::post( 'login', 'Auth\ApiAuthStreamerController@authenticate' );
    Route::post( 'register', 'Auth\ApiAuthStreamerController@register' );

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post( 'update-profile-image', 'Auth\ApiAuthStreamerController@updateProfileImage' );
        Route::put( 'update-profile', 'Auth\ApiAuthStreamerController@updateProfileImage' );
        Route::put( 'update-profile-password', 'Auth\ApiAuthStreamerController@updateProfilePassword' );
        Route::get( 'me', 'Auth\ApiAuthStreamerController@getAuthenticatedUser' );
    });

} );
