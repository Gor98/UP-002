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

// Auth Routes
Route::group(['namespace' => 'Auth\Controllers', 'prefix' => 'auth'], function() {
    Route::group(['prefix' => 'oauth2'], function() {
        Route::get('/url', ['as' => 'auth.oauth2Url', 'uses' => 'OAuth2Controller']);
    });
    Route::group(['prefix' => 'password'], function() {
        Route::post('/set', ['as' => 'auth.setPassword', 'uses' => 'PasswordController@set']);
        Route::post('/reset', ['as' => 'auth.resetPassword', 'uses' => 'PasswordController@reset']);
    });
    Route::patch('/verify', ['as' => 'auth.verify', 'uses' => 'VerifyController']);
    Route::post('/login', ['as' => 'auth.login', 'uses' => 'LoginController@login']);
    Route::post('/logout', ['as' => 'auth.logout', 'uses' => 'LoginController@logout'])->middleware('auth');
    Route::post('/register', ['as' => 'auth.register', 'uses' => 'RegisterController']);
});

// User Routes
Route::group(['namespace' => 'User\Controllers', 'prefix' => 'user', 'middleware' => ['auth']], function() {
    Route::get('/profile', ['as' => 'user.profile', 'uses' => 'ProfileController@profile']);
    Route::put('/update', ['as' => 'user.update', 'uses' => 'ProfileController@update']);
    Route::get('/testVerify', ['as' => 'user.testVerify', 'uses' => 'ProfileController@testVerify'])->middleware('verified');
});
