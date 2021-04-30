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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Apps
// Route::get('/', '\App\Http\Controllers\AppController@index');
Route::get('/upload', '\App\Http\Controllers\AppController@upload');
Route::get('/test', '\App\Http\Controllers\AppController@test');
Route::get('/dashboard', '\App\Http\Controllers\AppController@dashboard');



// Auth routes
Route::group(['middleware' => 'api'], function($router) {
    Route::post('auth/login', '\App\Http\Controllers\AuthController@login');
    Route::post('auth/logout', '\App\Http\Controllers\AuthController@logout');
    Route::post('auth/refresh', '\App\Http\Controllers\AuthController@refresh');
    Route::post('auth/me', '\App\Http\Controllers\AuthController@me');
    Route::post('auth/password-token', '\App\Http\Controllers\AuthController@passwordToken');
    Route::post('auth/password-reset', '\App\Http\Controllers\AuthController@passwordReset');
});





// Route::group(['middleware' => ['auth:api', 'permission']], function($router) {
// });



// Convigurações
Route::get('/setting/search', '\App\Http\Controllers\SettingController@search');
Route::get('/setting/find/{id}', '\App\Http\Controllers\SettingController@find');
Route::post('/setting/save', '\App\Http\Controllers\SettingController@save');
Route::post('/setting/delete/{id}', '\App\Http\Controllers\SettingController@delete');
Route::get('/setting/all', '\App\Http\Controllers\SettingController@all');

// E-mails
Route::get('/email/search', '\App\Http\Controllers\EmailController@search');
Route::get('/email/find/{id}', '\App\Http\Controllers\EmailController@find');
Route::post('/email/save', '\App\Http\Controllers\EmailController@save');
Route::post('/email/delete/{id}', '\App\Http\Controllers\EmailController@delete');

// Emails enviados
Route::get('/email-sent/search', '\App\Http\Controllers\EmailSentController@search');
Route::get('/email-sent/find/{id}', '\App\Http\Controllers\EmailSentController@find');
Route::post('/email-sent/save', '\App\Http\Controllers\EmailSentController@save');
Route::post('/email-sent/delete/{id}', '\App\Http\Controllers\EmailSentController@delete');



// \App\Settings::register([
//     'jwt-ttl' => [
//         'description' => 'Tempo de duração de autenticação',
//         'value' => (60*24),
//     ],
//     'format-datetime' => [
//         'description' => 'Formato de data/hora',
//         'value' => 'd/m/Y H:i',
//     ],
//     'format-date' => [
//         'description' => 'Formato de data',
//         'value' => 'd/m/Y',
//     ],
//     'format-time' => [
//         'description' => 'Formato de hora',
//         'value' => 'H:i',
//     ],
// ]);

include __DIR__ . '/api-generated.php';