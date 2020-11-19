<?php

// User
\App\Utils::fieldCreate(\App\Models\User::class, 'name', function($table) {
    $table->string('name')->nullable();
});

\App\Utils::fieldCreate(\App\Models\User::class, 'email', function($table) {
    $table->string('email')->nullable();
});

\App\Utils::fieldCreate(\App\Models\User::class, 'email_verified_at', function($table) {
    $table->timestamp('email_verified_at')->nullable();
});

\App\Utils::fieldCreate(\App\Models\User::class, 'password', function($table) {
    $table->string('password');
    $table->rememberToken();
});

\App\Utils::fieldCreate(\App\Models\User::class, 'meta', function($table) {
    $table->text('meta')->nullable();
});

\App\Utils::fieldCreate(\App\Models\User::class, 'group', function($table) {
    $table->string('group')->nullable();
});

\App\Utils::dbSeed(\App\Models\User::class, 1, function() {
    \App\Models\User::create([
        'id' => 1,
        'name' => 'Root User',
        'email' => 'root@grr.la',
        'password' => \Illuminate\Support\Facades\Hash::make('321321'),
        'group' => 'root',
    ]);

    \Illuminate\Support\Facades\Schema::create('password_resets', function ($table) {
        $table->string('email');
        $table->string('token');
        $table->timestamp('created_at')->nullable();
    });
});


// Users notifications
\App\Utils::fieldCreate(\App\Models\UserNotification::class, 'user_id', function($table) {
    $table->integer('user_id')->nullable();
});

\App\Utils::fieldCreate(\App\Models\UserNotification::class, 'title', function($table) {
    $table->string('title')->nullable();
});

\App\Utils::fieldCreate(\App\Models\UserNotification::class, 'body', function($table) {
    $table->text('body')->nullable();
});

\App\Utils::fieldCreate(\App\Models\UserNotification::class, 'image', function($table) {
    $table->text('image')->nullable();
});

\App\Utils::fieldCreate(\App\Models\UserNotification::class, 'seen', function($table) {
    $table->integer('seen')->default(0)->nullable();
});


// Emails
\App\Utils::fieldCreate(\App\Models\Email::class, 'to', function($table) {
    $table->text('to')->nullable();
});

\App\Utils::fieldCreate(\App\Models\Email::class, 'subject', function($table) {
    $table->text('subject')->nullable();
});

\App\Utils::fieldCreate(\App\Models\Email::class, 'body', function($table) {
    $table->text('body')->nullable();
});
