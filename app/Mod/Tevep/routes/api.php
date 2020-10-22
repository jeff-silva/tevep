<?php

\Route::get('/tevep/test', function() {
    $user = \App\User::find(2);
    // dd(new \App\Mail\UserCreated($user));
    return \Mail::send(new \App\Mail\UserCreated($user));
});