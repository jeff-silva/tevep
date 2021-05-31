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


// Apps
// Route::get('/', '\App\Http\Controllers\AppController@index');
// Route::get('/upload', '\App\Http\Controllers\AppController@upload');
// Route::get('/cron', '\App\Http\Controllers\AppController@cron');
// Route::get('/dashboard', '\App\Http\Controllers\AppController@dashboard');


// // Auth routes
// Route::group(['middleware' => 'api'], function($router) {
//     Route::post('auth/login', '\App\Http\Controllers\AuthController@login');
//     Route::post('auth/logout', '\App\Http\Controllers\AuthController@logout');
//     Route::post('auth/refresh', '\App\Http\Controllers\AuthController@refresh');
//     Route::post('auth/me', '\App\Http\Controllers\AuthController@me');
//     Route::post('auth/password-token', '\App\Http\Controllers\AuthController@passwordToken');
//     Route::post('auth/password-reset', '\App\Http\Controllers\AuthController@passwordReset');
// });

include __DIR__ . '/api-generated.php';

