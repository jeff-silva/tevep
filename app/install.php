<?php

// User
\App\Utils::fieldCreate(\App\Models\User::class, 'meta', function($table) {
    $table->text('meta')->nullable();
});

\App\Utils::fieldCreate(\App\Models\User::class, 'group_id', function($table) {
    $table->integer('group_id')->nullable();
});


// User groups
\App\Utils::fieldCreate(\App\Models\UserGroup::class, 'name', function($table) {
    $table->text('name')->nullable();
});

\App\Utils::dbSeed(\App\Models\UserGroup::class, 1, function() {
    \App\Models\UserGroup::create([
        'id' => '1',
        'name' => 'Root Group',
    ]);

    \App\Models\User::where('id', 1)->update(['group_id'=>1]);
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
