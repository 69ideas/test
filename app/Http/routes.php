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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin\\'], function () {

    Route::get('sign-in', ['as' => 'admin.sign-in', 'uses' => 'Auth@sign_in']);
    Route::post('sign-in', ['as' => 'admin.sign-in.post', 'uses' => 'Auth@sign_in_post']);


    Route::group(["middleware" => 'auth','admin'], function () {
        Route::get('', ['as' => 'admin.index', function () {
            return view('admin.layout');
        }]);
        Route::get('sign-out', ['as' => 'admin.sign-out', 'uses' => 'Auth@sign_out']);


        Route::resource('user', 'Users');
        Route::resource('event', 'Events');
        Route::resource('participant', 'Participants');
        Route::get('participant/entity_list', ['as' => 'admin.participant.entity_list', 'uses' => 'Participants@entity_list']);
        Route::get('/event/{participant}/detach', ['as' => 'admin.participant.detach', 'uses' => 'Participants@detach']);
        Route::resource('faq', 'Faqs', ['except' => ['show']]);
        Route::resource('page', 'Pages', ['except' => ['show']]);
        
    });
});
