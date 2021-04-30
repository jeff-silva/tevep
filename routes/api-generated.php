<?php

Route::get('/tevep-invite/search', '\App\Http\Controllers\TevepInviteController@search')->name('tevep-invite-search');
Route::get('/tevep-invite/find/{id}', '\App\Http\Controllers\TevepInviteController@find')->name('tevep-invite-find');
Route::post('/tevep-invite/save', '\App\Http\Controllers\TevepInviteController@save')->name('tevep-invite-save');
Route::post('/tevep-invite/delete/{id}', '\App\Http\Controllers\TevepInviteController@delete')->name('tevep-invite-delete');
Route::get('/tevep/search', '\App\Http\Controllers\TevepController@search')->name('tevep-search');
Route::get('/tevep/find/{id}', '\App\Http\Controllers\TevepController@find')->name('tevep-find');
Route::post('/tevep/save', '\App\Http\Controllers\TevepController@save')->name('tevep-save');
Route::post('/tevep/delete/{id}', '\App\Http\Controllers\TevepController@delete')->name('tevep-delete');
Route::get('/user-notification/search', '\App\Http\Controllers\UserNotificationController@search')->name('user-notification-search');
Route::get('/user-notification/find/{id}', '\App\Http\Controllers\UserNotificationController@find')->name('user-notification-find');
Route::post('/user-notification/save', '\App\Http\Controllers\UserNotificationController@save')->name('user-notification-save');
Route::post('/user-notification/delete/{id}', '\App\Http\Controllers\UserNotificationController@delete')->name('user-notification-delete');
Route::get('/user/search', '\App\Http\Controllers\UserController@search')->name('user-search');
Route::get('/user/find/{id}', '\App\Http\Controllers\UserController@find')->name('user-find');
Route::post('/user/save', '\App\Http\Controllers\UserController@save')->name('user-save');
Route::post('/user/delete/{id}', '\App\Http\Controllers\UserController@delete')->name('user-delete');