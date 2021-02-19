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
    if ($tevep = \Tevep\Models\Tevep::find($id)) {
        $pingpongs = is_array($tevep->pingpongs)? $tevep->pingpongs: [];
        
        if (0 == sizeof(array_filter($pingpongs, function($ping) use($userId) { return $ping['user_to']==$userId; }))) {
            if ($user = \App\Models\User::find($userId)) {
                $pingpong = [
                    'id' => uniqid('pingpong-'),
                    'user_from' => 0,
                    'user_to' => $userId,
                    'user_to_name' => $user->name,
                    'user_to_email' => $user->email,
                    'accepted' => false,
                ];

                $link = url("/tevep2/{$tevep->id}/?pingpong={$pingpong['id']}");
                \App\Utils::mail([
                    'to' => $user->email,
                    'subject' => 'Convite pingpong',
                    'body' => "Para aceitar, clique <a href='{$link}'>aqui</a>.",
                ]);
                $pingpongs[] = $pingpong;
            }
        }

        $tevep->pingpongs = $pingpongs;
        $tevep->store();
        return $tevep;
    }
    
    throw new \Exception('Tevep não encontrado');
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
