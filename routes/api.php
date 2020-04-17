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

Route::group(['middleware' => ['cors']], function () {
    Route::post('/', function (Request $request) {
        return $request->get('name');
    });
});
Route::group(['middleware' => ['cors']], function () {
    Route::group(['prefix' => 'follower'], function () {
        Route::post('login', 'Auth\ApiAuthFollowerController@authenticate');
        Route::post('register', 'Auth\ApiAuthFollowerController@register');

        Route::group(['middleware' => ['jwt.verify']], function () {
            Route::post('update-profile-image', 'Auth\ApiAuthFollowerController@updateProfileImage');
            Route::put('update-profile', 'Auth\ApiAuthFollowerController@updateProfile');
            Route::put('update-profile-password', 'Auth\ApiAuthFollowerController@updateProfilePassword');
            Route::get('me', 'Auth\ApiAuthFollowerController@getAuthenticatedUser');
        });
    });
    Route::group(['prefix' => 'streamer'], function () {
        Route::post('login', 'Auth\ApiAuthStreamerController@authenticate');
        Route::post('register', 'Auth\ApiAuthStreamerController@register');
        Route::group(['middleware' => ['jwt.verify']], function () {
            Route::post('update-profile-image', 'Auth\ApiAuthStreamerController@updateProfileImage');
            Route::put('update-profile', 'Auth\ApiAuthStreamerController@updateProfile');
            Route::put('update-profile-password', 'Auth\ApiAuthStreamerController@updateProfilePassword');
            Route::get('me', 'Auth\ApiAuthStreamerController@getAuthenticatedUser');
            //===========================Start=Quiz=============================================
            Route::get('quiz', 'api\QuizController@quizes');
            Route::post('create_quiz', 'api\QuizController@createQuiz');
            Route::get('quiz/{slug}', 'api\QuizController@Detail_quiz');
            Route::put('quiz/{slug}', 'api\QuizController@Update_quiz');
            Route::delete('quiz/{slug}', 'api\QuizController@Delete_quiz');
            //===========================End=Quiz=============================================
            //===========================Start=Question=============================================
            Route::get('{quiz}/question', 'api\QuestionController@question');
            Route::post('{quiz}/create_question', 'api\QuestionController@createQuestion');
            Route::get('{quiz}/question/{slug}', 'api\QuestionController@Detail_question');
            //===========================End=Question=============================================
        });
    });
});
