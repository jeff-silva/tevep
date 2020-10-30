<?php

\Tevep\Models\Tevep::fieldCreate('user_id', function($table) {
    $table->integer('user_id')->nullable();
});

\Tevep\Models\Tevep::fieldCreate('title', function($table) {
    $table->string('title')->nullable();
});

\Tevep\Models\Tevep::fieldCreate('divisor', function($table) {
    $table->string('divisor')->nullable();
});

\Tevep\Models\Tevep::fieldCreate('nodes', function($table) {
    $table->text('nodes')->nullable();
});

\Tevep\Models\Tevep::fieldCreate('date_start', function($table) {
    $table->dateTime('date_start')->nullable();
});

\Tevep\Models\Tevep::fieldCreate('date_final', function($table) {
    $table->dateTime('date_final')->nullable();
});

\Tevep\Models\Tevep::fieldCreate('deleted_at', function($table) {
    $table->dateTime('deleted_at')->nullable();
});
