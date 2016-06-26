<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

    Route::get('/', ['as' => 'home', 'uses' => 'Frontend\Home@index']);
    Route::get('login', ['as' => 'login', 'uses' => 'Frontend\AuthController@sign_in']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Frontend\AuthController@sign_in_post']);
    Route::get('register', ['as' => 'register', 'uses' => 'Frontend\AuthController@register']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'Frontend\AuthController@register_post']);
    Route::get('/activate/{hash}', ['as' => 'activate', 'uses' => 'Frontend\AuthController@activate']);

Route::group(["middleware" => ['auth']], function () {
     Route::get('profile', ['as' => 'profile', 'uses' => 'Frontend\Home@profile']);
     Route::get('event', ['as' => 'profile', 'uses' => 'Frontend\Home@event']);
     Route::patch('profile', ['as' => 'profile.post', 'uses' => 'Frontend\Users@update']);
     Route::resource('event', 'Frontend\Events');
     Route::get('logout', 'Frontend\AuthController@sign_out');
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin\\'], function () {

    Route::get('sign-in', ['as' => 'admin.sign-in', 'uses' => 'Auth@sign_in']);
    Route::post('sign-in', ['as' => 'admin.sign-in.post', 'uses' => 'Auth@sign_in_post']);
    Route::group(["middleware" => ['auth', 'admin']], function () {
        Route::get('', ['as' => 'admin.index', function () {
            return view('admin.layout');
        }]);
        Route::get('sign-out', ['as' => 'admin.sign-out', 'uses' => 'Auth@sign_out']);

        Route::get('/event/{event}/close', ['as' => 'admin.event.close', 'uses' => 'Events@close']);
        Route::resource('user', 'Users');
        Route::resource('event', 'Events');
        Route::resource('participant', 'Participants');
        Route::get('article/{article}/destroy', ['as' => 'admin.article.destroy', 'uses' => 'Articles@destroy']);
        Route::get('participant/entity_list', ['as' => 'admin.participant.entity_list', 'uses' => 'Participants@entity_list']);
        Route::get('/event/{participant}/detach', ['as' => 'admin.participant.detach', 'uses' => 'Participants@detach']);
        Route::resource('faq', 'Faqs', ['except' => ['show']]);
        Route::resource('article', 'Articles', ['except' => ['show', 'destroy']]);
        Route::resource('page', 'Pages', ['except' => ['show']]);

    });
});
