<?php

\App\Utils::fieldCreate(\Tevep\Models\Tevep::class, 'user_id', function($table) {
    $table->integer('user_id')->nullable();
});

\App\Utils::fieldCreate(\Tevep\Models\Tevep::class, 'title', function($table) {
    $table->string('title')->nullable();
});

\App\Utils::fieldCreate(\Tevep\Models\Tevep::class, 'divisor', function($table) {
    $table->string('divisor')->nullable();
});

\App\Utils::fieldCreate(\Tevep\Models\Tevep::class, 'nodes', function($table) {
    $table->text('nodes')->nullable();
});

\App\Utils::fieldCreate(\Tevep\Models\Tevep::class, 'date_start', function($table) {
    $table->dateTime('date_start')->nullable();
});

\App\Utils::fieldCreate(\Tevep\Models\Tevep::class, 'date_final', function($table) {
    $table->dateTime('date_final')->nullable();
});

\App\Utils::fieldCreate(\Tevep\Models\Tevep::class, 'deleted_at', function($table) {
    $table->dateTime('deleted_at')->nullable();
});
