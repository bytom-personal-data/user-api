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


Route::get('/', function() {
   return ['title' => 'Bytom Personal Identification API', 'type' => 'REST'];
});

Route::post('/signup', 'Api\UserController@signup')->name('user.signup');
Route::post('/login', 'Api\UserController@login')->name('user.login');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/user', 'Api\UserController@user')->name('user.user');
    Route::get('/unspents', 'Api\UserController@unspents')->name('user.unspents');

    Route::group(['prefix' => 'data'], function() {
       Route::post('/create', 'Api\DataController@add');
       Route::post('/request', 'Api\DataController@requestByLabel');
       Route::get('/get', 'Api\DataController@getByLabel');
    });
});

