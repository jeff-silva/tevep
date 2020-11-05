<?php

\App\Utils::fieldCreate('users', 'photo', function($table) {
    $table->text('photo')->nullable();
});

\App\Utils::fieldCreate('users', 'background', function($table) {
    $table->text('background')->nullable();
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