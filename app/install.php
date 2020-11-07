<?php

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
