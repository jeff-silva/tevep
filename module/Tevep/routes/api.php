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

Route::post('/tevep/{id}/pingpong/{userId}', function($id, $userId) {
    return \Tevep\Models\Tevep::find($id)->pingpong($userId);
});

Route::post('/tevep/{id}/pingpong-confirm/{pingpongId}', function($id, $pingpongId) {
    if ($tevep = \Tevep\Models\Tevep::find($id)) {
        $tevep->pingpongs = array_map(function($ping) use($pingpongId) {
            if ($ping['id']==$pingpongId) {
                $ping['accepted'] = true;
            }
            return $ping;
        }, $tevep->pingpongs);
        $tevep->store();
        return $tevep;
    }

    throw new \Exception('Tevep não encontrado');
});

Route::get('/tevep/search', function() {
    // return (new \Tevep\Models\Tevep)->search(request()->all())->paginate(15);
    return (new \Tevep\Models\Tevep)->apiSearch(request()->all());
});

Route::get('/tevep/find/{id}', function($id) {
    return \Tevep\Models\Tevep::findOrFail($id);
});

// Descobrir porque não aceita post e corrigir
Route::any('/tevep/store', function() {
    return (new \Tevep\Models\Tevep)->store(request()->all());
});

Route::post('/tevep/{id}/delete', function($id) {
    return \Tevep\Models\Tevep::find($id)->delete();
});
