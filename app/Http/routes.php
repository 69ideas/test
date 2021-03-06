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



Route::get('/', ['as' => 'home', 'uses' => 'Frontend\Pages@home']);
Route::get('login', ['as' => 'login', 'uses' => 'Frontend\AuthController@sign_in']);
Route::get('repeat', ['as' => 'repeat', 'uses' => 'Frontend\AuthController@repeat']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Frontend\AuthController@sign_in_post']);
Route::get('register', ['as' => 'register', 'uses' => 'Frontend\AuthController@register']);
Route::post('resend_the_link', ['as' => 'resend_the_link', 'uses' => 'Frontend\AuthController@resend_the_link']);
Route::post('register', ['as' => 'register.post', 'uses' => 'Frontend\AuthController@register_post']);
Route::get('/activate/{hash}', ['as' => 'activate', 'uses' => 'Frontend\AuthController@activate']);
Route::get('/event/show/{slug}', ['as' => 'show.event', 'uses' => 'Frontend\Pages@event']);
Route::get('/article/show/{slug}', ['as' => 'show.article', 'uses' => 'Frontend\Pages@article']);
Route::resource('tifas_event', 'Frontend\TIFASEvents');
Route::get('/payment/{event}', ['as' => 'payment', 'uses' => 'Frontend\Pages@open_payment']);
Route::get('/pay_fee/{event}', ['as' => 'pay_fee', 'uses' => 'PayReceipt@pay_fee']);
Route::post('/payment/{event}', ['as' => 'post.payment', 'uses' => 'PayReceipt@doAction']);
Route::get('error', ['as' => 'error', 'uses' => 'Frontend\Pages@home']);
Route::get('success1', ['as' => 'success1', 'uses' => 'Frontend\Pages@home']);
Route::get('payment_total', ['as' => 'payment_total', 'uses' => 'PayReceipt@payment_total']);
Route::get('another_entry', ['as' => 'another_entry', 'uses' => 'PayReceipt@another_entry']);
Route::get('forgot', ['as' => 'forgot', 'uses' => 'Frontend\AuthController@open_forgot']);
Route::get('reset/{url}', ['as' => 'reset', 'uses' => 'Frontend\AuthController@reset']);
Route::get('event_created/{event}', ['as' => 'event.created', 'uses' => 'Frontend\Events@event_created']);
Route::post('reset', ['as' => 'reset.post', 'uses' => 'Frontend\AuthController@reset_post']);
Route::post('forgot', ['as' => 'forgot.post', 'uses' => 'Frontend\AuthController@forgot']);
Route::get('find', ['as' => 'find', 'uses' => 'Frontend\Pages@find']);
Route::get('check/{id}', ['as' => 'check', 'uses' => 'PayReceipt@check']);
Route::post('find', ['as' => 'find.post', 'uses' => 'Frontend\Pages@post_find']);

Route::group(["middleware" => ['auth']], function () {
    Route::get('profile', ['as' => 'profile', 'uses' => 'Frontend\Home@profile']);
    Route::get('events', ['as' => 'event', 'uses' => 'Frontend\Home@event']);
    Route::patch('profile', ['as' => 'profile.post', 'uses' => 'Frontend\Users@update']);
    Route::get('participant/{participant}/refund', ['as'=>'participant.refund', 'uses'=>'Frontend\Participants@refund']);

    Route::resource('participant', 'Frontend\Participants');
    Route::get('payment_extended_info', ['as' => 'payment_extended_info', 'uses' => 'Frontend\Participants@payment_extended_info']);
    Route::get('/event/{event}/close', ['as' => 'frontend.event.close', 'uses' => 'Frontend\Events@close']);
    Route::get('/event/{event}/open', ['as' => 'frontend.event.open', 'uses' => 'Frontend\Events@open']);
    Route::get('/event/send', ['as' => 'frontend.event.send', 'uses' => 'Frontend\Events@send']);
    Route::post('/event/send', ['as' => 'post.send.email', 'uses' => 'Frontend\Events@send_email']);
    Route::post('/comment', ['as' => 'comment', 'uses' => 'Frontend\Comments@store']);
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
        Route::resource('photo', 'Photos', ['except' => ['show']]);

    });
});
Route::get('{url}', ['as' => 'page', 'uses' => 'Frontend\Pages@page']);
Route::get('/event/{event}', ['as' => 'event.show', 'uses' => 'Frontend\Events@show']);