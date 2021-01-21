<?php

\App\Settings::register([
    'jwt-ttl' => [
        'description' => 'Tempo de duração de autenticação',
        'value' => (60*24),
    ],
    'format-datetime' => [
        'description' => 'Formato de data/hora',
        'value' => 'd/m/Y H:i',
    ],
    'format-date' => [
        'description' => 'Formato de data',
        'value' => 'd/m/Y',
    ],
    'format-time' => [
        'description' => 'Formato de hora',
        'value' => 'H:i',
    ],
]);

Route::get('/tevep/search', function() {
    // return (new \Tevep\Models\Tevep)->search(request()->all())->paginate(15);
    return (new \Tevep\Models\Tevep)->apiSearch(request()->all());
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