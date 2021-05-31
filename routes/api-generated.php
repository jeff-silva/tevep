<?php

// File generated automatically
// Do not edit or your changes will be lost

Route::get('app/routes', '\App\Http\Controllers\AppController@getRoutes');
Route::get('app/upload', '\App\Http\Controllers\AppController@getUpload');
Route::get('app/cron', '\App\Http\Controllers\AppController@getCron');
Route::get('app/dashboard', '\App\Http\Controllers\AppController@getDashboard');

Route::post('auth/login', '\App\Http\Controllers\AuthController@postLogin');
Route::post('auth/me', '\App\Http\Controllers\AuthController@postMe');
Route::post('auth/logout', '\App\Http\Controllers\AuthController@postLogout');
Route::post('auth/refresh', '\App\Http\Controllers\AuthController@postRefresh');
Route::post('auth/password-token', '\App\Http\Controllers\AuthController@postPasswordToken');
Route::post('auth/password-reset', '\App\Http\Controllers\AuthController@postPasswordReset');


Route::get('email/search', '\App\Http\Controllers\EmailController@getSearch');
Route::get('email/find/{id}', '\App\Http\Controllers\EmailController@getFind');
Route::post('email/save', '\App\Http\Controllers\EmailController@postSave');
Route::post('email/delete/{id}', '\App\Http\Controllers\EmailController@postDelete');
Route::post('email/test', '\App\Http\Controllers\EmailController@postTest');

Route::get('email-sent/search', '\App\Http\Controllers\EmailSentController@getSearch');
Route::get('email-sent/find/{id}', '\App\Http\Controllers\EmailSentController@getFind');
Route::post('email-sent/save', '\App\Http\Controllers\EmailSentController@postSave');
Route::post('email-sent/delete/{id}', '\App\Http\Controllers\EmailSentController@postDelete');

Route::get('setting/search', '\App\Http\Controllers\SettingController@getSearch');
Route::get('setting/find/{id}', '\App\Http\Controllers\SettingController@getFind');
Route::post('setting/save', '\App\Http\Controllers\SettingController@postSave');
Route::post('setting/delete/{id}', '\App\Http\Controllers\SettingController@postDelete');
Route::get('setting/all', '\App\Http\Controllers\SettingController@getAll');

Route::get('tevep/search', '\App\Http\Controllers\TevepController@getSearch');
Route::get('tevep/find/{id}', '\App\Http\Controllers\TevepController@getFind');
Route::post('tevep/save', '\App\Http\Controllers\TevepController@postSave');
Route::post('tevep/delete/{id}', '\App\Http\Controllers\TevepController@postDelete');

Route::get('tevep-invite/search', '\App\Http\Controllers\TevepInviteController@getSearch');
Route::get('tevep-invite/find/{id}', '\App\Http\Controllers\TevepInviteController@getFind');
Route::post('tevep-invite/save', '\App\Http\Controllers\TevepInviteController@postSave');
Route::post('tevep-invite/delete/{id}', '\App\Http\Controllers\TevepInviteController@postDelete');

Route::get('user/search', '\App\Http\Controllers\UserController@getSearch');
Route::get('user/find/{id}', '\App\Http\Controllers\UserController@getFind');
Route::post('user/save', '\App\Http\Controllers\UserController@postSave');
Route::post('user/delete/{id}', '\App\Http\Controllers\UserController@postDelete');

Route::get('user-notification/search', '\App\Http\Controllers\UserNotificationController@getSearch');
Route::get('user-notification/find/{id}', '\App\Http\Controllers\UserNotificationController@getFind');
Route::post('user-notification/save', '\App\Http\Controllers\UserNotificationController@postSave');
Route::post('user-notification/delete/{id}', '\App\Http\Controllers\UserNotificationController@postDelete');
