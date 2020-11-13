<?php

// Users notifications
\App\Utils::fieldCreate('user_notifications', 'user_id', function($table) {
    $table->integer('user_id')->nullable();
});

\App\Utils::fieldCreate('user_notifications', 'title', function($table) {
    $table->string('title')->nullable();
});

\App\Utils::fieldCreate('user_notifications', 'body', function($table) {
    $table->text('body')->nullable();
});

\App\Utils::fieldCreate('user_notifications', 'image', function($table) {
    $table->text('image')->nullable();
});

\App\Utils::fieldCreate('user_notifications', 'seen', function($table) {
    $table->integer('seen')->default(0)->nullable();
});


// Emails
\App\Utils::fieldCreate('users', 'meta', function($table) {
    $table->text('meta')->nullable();
});


\App\Utils::fieldCreate('emails', 'to', function($table) {
    $table->text('to')->nullable();
});

\App\Utils::fieldCreate('emails', 'subject', function($table) {
    $table->text('subject')->nullable();
});

\App\Utils::fieldCreate('emails', 'body', function($table) {
    $table->text('body')->nullable();
});

