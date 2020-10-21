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

Route::post('/auth/register', 'UserController@register');
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::post('/call', function() {
    $class = '\App\\'. request()->input('class');
    $method = request()->input('method');
    $arguments = request()->input('arguments');
    $attributes = request()->input('attributes');

    $instance = call_user_func([$class, 'find'], $attributes['id']);
    $instance = $instance? $instance: new $class();
    $instance->fill($attributes);

    $call = [$instance, $method];
    if (is_callable($call) AND is_array($instance->jsMethods) AND isset($instance->jsMethods[$method])) {
        return call_user_func_array($call, $arguments);
    }

    return ['error' => 'Cant execute'];
});


Route::resource('tevep', 'TevepController');


Route::group(['prefix' => 'teveps'], function($router) {
    Route::get('find', 'TevepController@find');
    Route::get('search', 'TevepController@search');
    Route::post('save', 'TevepController@save');
    Route::post('delete', 'TevepController@delete');
});



return;
foreach(\App\Utils::classes() as $model) {
    $instance = new $model;
    $table_name = $instance->getTable();
    Route::group(['prefix' => $table_name], function($router) use($model, $instance, $table_name) {
        $methods = get_class_methods($instance);

        if (in_array('endpoints', $methods)) {
            call_user_func([$instance, 'endpoints']);
        }
    
        // search
        $call = function() use($instance) {
            $input = request()->all();
            return $instance->get();
        };
        
        if (in_array('search', get_class_methods($instance))) {
            $call = function() use($instance) {
                return call_user_func([$instance, 'search'], request()->all());
            };
        }
        
        \Route::get('/search', $call);

    
        // find by id
        \Route::get('/find', function() use($instance) {
            $request = request();

            if ($item = $instance->find($request->input('id'))) {
                return $item;
            }

            throw new \Exception('Item não encontrado');
        });
    
        //  save
        \Route::post('/save', function() use($model, $instance, $methods) {
            $request = request();

            $all = array_merge($instance->ToArray(), $request->all());
            if (isset($all['id'])) unset($all['id']);

            $save = new $model;
            if ($find = $instance->find($request->input('id'))) {
                $save = $find;
            }

            $save = $save->fill($all);

            if (in_array('validation', $methods)) {
                $err = call_user_func([$save, 'validation']);
                if ($err->hasError()) {
                    return [
                        'error' => $err->errors(),
                    ];
                }
            }

            $save->save();
            return $save;
        });
    
        //  delete
        \Route::post('/delete', function() {
            $request = request();
            return $request->all();
        });
    });
}


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