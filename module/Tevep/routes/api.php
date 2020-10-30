<?php

Route::get('/tevep/search', function() {
    return (new \Tevep\Models\Tevep)->search(request()->all())->paginate(15);
});

Route::get('/tevep/find/{id}', function($id) {
    return \Tevep\Models\Tevep::findOrFail($id);
});

Route::post('/tevep/store', function() {
    return (new \Tevep\Models\Tevep)->fill(request()->all())->store();
});

Route::post('/tevep/delete/{id}', function($id) {
    return \Tevep\Models\Tevep::find($id)->delete();
});