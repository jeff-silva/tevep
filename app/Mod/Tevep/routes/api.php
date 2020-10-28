<?php

Route::get('/tevep/search', function() {
    return (new \App\Mod\Tevep\Models\Tevep)->search(request()->all());
});

Route::post('/tevep/store', function() {
    return (new \App\Mod\Tevep\Models\Tevep)->store(request()->all());
});