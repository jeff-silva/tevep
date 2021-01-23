<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Show all endpoints
Route::get('/', function() {
    $routes = [];

    foreach(\Route::getRoutes() as $route) {
        $routes[] = [
            'methods' => $route->methods(),
            'uri' => $route->uri(),
        ];
    }

    return $routes;
});

Route::get('/settings', function() {
    return \App\Settings::all();
});


// Auth routes
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function($router) {
    Route::post('login', '\App\Http\Controllers\AuthController@login');
    Route::post('logout', '\App\Http\Controllers\AuthController@logout');
    Route::post('refresh', '\App\Http\Controllers\AuthController@refresh');
    Route::post('me', '\App\Http\Controllers\AuthController@me');
    
    Route::post('password-token', function() {
        return \App\Models\User::passwordToken(request()->all());
    })->name('password.reset');
    
    Route::post('password-reset', function() {
        return \App\Models\User::passwordReset(request()->all());
    });
});

Route::get('/user/find', function() {
    return \App\Models\User::find(request()->input('id'));
});

Route::get('/user/notifications', function() {
    if ($user = auth()->user()) {
        return (new \App\Models\UserNotification)->search(function($query, $request) use($user) {
            $query = $query->where('user_id', $user->id);

            $seen = $request->input('seen');
            if (is_numeric($seen)) {
                $query = $query->where('seen', $seen);
            }

            return $query;
        });
    }
    return [];
});

Route::post('/user/notification/{id}', function($id) {
    if ($notif = \App\Models\UserNotification::find($id)) {
        $notif->update(['seen'=>1]);
        return $notif;
    }

    return false;
});

// User register/save
foreach(['/user/save', '/user/store', '/user/register'] as $path) {
    Route::post($path, function() {
        return (new \App\Models\User)->fill(request()->all())->store();
    });
}


Route::get('/user/search', function() {
    $params = (object) [
        'search' => request()->input('search', ''),
        'page' => request()->input('page', 1),
        'perpage' => request()->input('perpage', 10),
    ];
    
    $query = new \App\Models\User();

    if ($params->search) {
        $query = $query->where(function($query) use($params) {
            $query->where('name', 'like', "%{$params->search}%");
            $query->orWhere('email', 'like', "%{$params->search}%");
        });
    }

    $query->params = $params;
    return $query->paginate(10);
});


Route::post('/user/delete', function() {
    return ['?'];
});

Route::post('/upload', function(Request $request) {
    $folder = $request->input('folder', 'uploads');
    $file = $request->file('file');
    
    $info = pathinfo($file->getClientOriginalName());
    $filename = \Str::slug($info['filename'], '-') .'.'. $info['extension'];
    $path = $file->storeAs($folder, $filename, 'public');

    return [
        'path' => "storage/{$path}",
        'name' => $filename,
        'ext' => $info['extension'],
        'size' => Storage::disk('public')->size($path),
        'mime' => Storage::disk('public')->getMimeType($path),
        'url' => Storage::disk('public')->url($path),
    ];
});
