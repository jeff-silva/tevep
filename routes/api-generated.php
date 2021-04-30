<?php

\App\Http\RouteController::load(\App\Http\Controllers\TevepInviteController::class, [
	'prefix' => 'tevep-invite',
]);

\App\Http\RouteController::load(\App\Http\Controllers\TevepController::class, [
	'prefix' => 'tevep',
]);

\App\Http\RouteController::load(\App\Http\Controllers\UserNotificationController::class, [
	'prefix' => 'user-notification',
]);

\App\Http\RouteController::load(\App\Http\Controllers\UserController::class, [
	'prefix' => 'user',
]);
