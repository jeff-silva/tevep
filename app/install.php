<?php

\App\Utils::fieldCreate('users', 'photo', function($table) {
    $table->text('photo')->nullable();
});
