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

Route::group(['prefix' => 'auth', 'as' => 'auth.'], static function (){
    Route::post('/sign-in', 'AuthController@signIn')->name('sign-in');
    Route::post('/sign-in-token', 'AuthController@signInByToken')->name('sign-in-token');
    Route::post('/sign-up', 'AuthController@signUp')->name('sign-up');
    Route::get('/confirm-email', 'AuthController@confirmEmail')->name('confirm-email');
    Route::post('/forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
});