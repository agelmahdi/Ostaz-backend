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

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::get('/', function () {

        return view('welcome');
    });
});

Route::get('/500', function () {
    return view('page500');
})->name('page500');

/**
 * Admin login route
 */
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.post');
Route::post('/admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');


/**
 * route only for Admin profile
 */
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::group([
        'as' => 'Admin.',
        'prefix' => 'Admin',
        'namespace' => 'Admin',
        'middleware' => ['auth', 'admin']
    ], function () {
        Route::get('/dashboard', 'HomeController@index')->name('home');
        Route::resource('roles', 'RoleController');
        Route::resource('users', 'UserController');
        Route::resource('products', 'ProductController');
        Route::resource('permissioncategories', 'PermissioncategoryController');
        Route::resource('permissions', 'PermissionController');
        Route::resource('options', 'OptionController');
        Route::resource('localization', 'LocalizationController');
        Route::resource('adminlocalization', 'AdminLocalizationController');
        Route::get('web_setting', 'WebSettingController@index')->name('websetting.index');
        Route::put('web_setting', 'WebSettingController@update')->name('web_setting.update');
        Route::resource('category', 'CategoryController');
        Route::resource('subcategory', 'SubCategoryController');
        Route::resource('quiz', 'QuizController');
        Route::resource('academicyears', 'AcademicController');
        Route::resource('subject', 'SubjectController');
        //     _____________________________Question_____________________________________________________
        Route::get('question/{quiz}', 'QuestionController@index')->name('question.index');
        Route::get('question/{quiz}/create', 'QuestionController@create')->name('question.create');
        Route::post('question/{quiz}/store', 'QuestionController@store')->name('question.store');
        Route::get('question/{question}/edit', 'QuestionController@edit')->name('question.edit');
        Route::put('question/{question}', 'QuestionController@update')->name('question.update');
        Route::delete('question/{question}', 'QuestionController@destroy')->name('question.destroy');
        //        ___________________________End__Question_______________________________________________
        //     _____________________________Answer_____________________________________________________
        Route::get('answer/{question}', 'AnswerController@index')->name('answer.index');
        Route::get('answer/{question}/create', 'AnswerController@create')->name('answer.create');
        Route::post('answer/{question}/store', 'AnswerController@store')->name('answer.store');
        Route::get('answer/{answer}/edit', 'AnswerController@edit')->name('answer.edit');
        Route::put('answer/{answer}', 'AnswerController@update')->name('answer.update');
        Route::delete('answer/{answer}', 'AnswerController@destroy')->name('answer.destroy');

        //        ___________________________End__Answer________________________________________________
    });
});
        Route::get('answer/changeStatus', 'Admin\AnswerController@ChangeStatus');
/**
 * follower login route
 */
Route::get('/follower/login', 'Auth\FollowerLoginController@showLoginForm')->name('follower.login');
Route::post('/follower/login', 'Auth\FollowerLoginController@login')->name('follower.login.post');
Route::post('/follower/logout', 'Auth\FollowerLoginController@logout')->name('follower.logout');


/**
 * route only for follower profile
 */
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::group(['middleware' => 'follower'], function () {

        Route::get('/follower/home', 'Follower\HomeController@index');

    });
});

/**
 * follower login route
 */
Route::get('/streamer/login', 'Auth\StreamerLoginController@showLoginForm')->name('streamer.login');
Route::post('/streamer/login', 'Auth\StreamerLoginController@login')->name('streamer.login.post');
Route::post('/streamer/logout', 'Auth\StreamerLoginController@logout')->name('streamer.logout');


/**
 * route only for follower profile
 */
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Route::group(['middleware' => 'streamer'], function () {

        Route::get('/streamer/home', 'Streamer\HomeController@index');

    });
});
