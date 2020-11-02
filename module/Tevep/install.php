<?php

\App\Utils::fieldCreate('teveps', 'user_id', function($table) {
    $table->integer('user_id')->nullable();
});

\App\Utils::fieldCreate('teveps', 'title', function($table) {
    $table->string('title')->nullable();
});

\App\Utils::fieldCreate('teveps', 'divisor', function($table) {
    $table->string('divisor')->nullable();
});

\App\Utils::fieldCreate('teveps', 'nodes', function($table) {
    $table->text('nodes')->nullable();
});

\App\Utils::fieldCreate('teveps', 'date_start', function($table) {
    $table->dateTime('date_start')->nullable();
});

\App\Utils::fieldCreate('teveps', 'date_final', function($table) {
    $table->dateTime('date_final')->nullable();
});

\App\Utils::fieldCreate('teveps', 'deleted_at', function($table) {
    $table->dateTime('deleted_at')->nullable();
});
