<?php

\App\Utils::fieldCreate('users', 'photo', function($table) {
    $table->text('photo')->nullable();
});

\App\Utils::fieldCreate('users', 'background', function($table) {
    $table->text('background')->nullable();
});
