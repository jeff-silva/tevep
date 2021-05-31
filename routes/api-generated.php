<?php




Route::get('tevep-invite/search/{request}', '\App\Http\Controllers\TevepInviteController@getSearch');
Route::get('tevep-invite/find/{id}', '\App\Http\Controllers\TevepInviteController@getFind');
Route::post('tevep-invite/save/{request}', '\App\Http\Controllers\TevepInviteController@postSave');
Route::post('tevep-invite/delete/{id}', '\App\Http\Controllers\TevepInviteController@postDelete');

Route::get('tevep/search/{request}', '\App\Http\Controllers\TevepController@getSearch');
Route::get('tevep/find/{id}', '\App\Http\Controllers\TevepController@getFind');
Route::post('tevep/save/{request}', '\App\Http\Controllers\TevepController@postSave');
Route::post('tevep/delete/{id}', '\App\Http\Controllers\TevepController@postDelete');

Route::get('user-notification/search/{request}', '\App\Http\Controllers\UserNotificationController@getSearch');
Route::get('user-notification/find/{id}', '\App\Http\Controllers\UserNotificationController@getFind');
Route::post('user-notification/save/{request}', '\App\Http\Controllers\UserNotificationController@postSave');
Route::post('user-notification/delete/{id}', '\App\Http\Controllers\UserNotificationController@postDelete');

Route::get('user/search/{request}', '\App\Http\Controllers\UserController@getSearch');
Route::get('user/find/{id}', '\App\Http\Controllers\UserController@getFind');
Route::post('user/save/{request}', '\App\Http\Controllers\UserController@postSave');
Route::post('user/delete/{id}', '\App\Http\Controllers\UserController@postDelete');