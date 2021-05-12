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

// Apps
// Route::get('/', '\App\Http\Controllers\AppController@index');
// Route::get('/upload', '\App\Http\Controllers\AppController@upload');
// Route::get('/test', '\App\Http\Controllers\AppController@test');
// Route::get('/dashboard', '\App\Http\Controllers\AppController@dashboard');



// Auth routes
// Route::group(['middleware' => 'api'], function($router) {
//     Route::post('auth/login', '\App\Http\Controllers\AuthController@login');
//     Route::post('auth/logout', '\App\Http\Controllers\AuthController@logout');
//     Route::post('auth/refresh', '\App\Http\Controllers\AuthController@refresh');
//     Route::post('auth/me', '\App\Http\Controllers\AuthController@me');
//     Route::post('auth/password-token', '\App\Http\Controllers\AuthController@passwordToken');
//     Route::post('auth/password-reset', '\App\Http\Controllers\AuthController@passwordReset');
// });





// Route::group(['middleware' => ['auth:api', 'permission']], function($router) {
// });



// // Convigurações
// Route::get('/setting/search', '\App\Http\Controllers\SettingController@search');
// Route::get('/setting/find/{id}', '\App\Http\Controllers\SettingController@find');
// Route::post('/setting/save', '\App\Http\Controllers\SettingController@save');
// Route::post('/setting/delete/{id}', '\App\Http\Controllers\SettingController@delete');
// Route::get('/setting/all', '\App\Http\Controllers\SettingController@all');

// // E-mails
// Route::get('/email/search', '\App\Http\Controllers\EmailController@search');
// Route::get('/email/find/{id}', '\App\Http\Controllers\EmailController@find');
// Route::post('/email/save', '\App\Http\Controllers\EmailController@save');
// Route::post('/email/delete/{id}', '\App\Http\Controllers\EmailController@delete');

// // Emails enviados
// Route::get('/email-sent/search', '\App\Http\Controllers\EmailSentController@search');
// Route::get('/email-sent/find/{id}', '\App\Http\Controllers\EmailSentController@find');
// Route::post('/email-sent/save', '\App\Http\Controllers\EmailSentController@save');
// Route::post('/email-sent/delete/{id}', '\App\Http\Controllers\EmailSentController@delete');

// include __DIR__ . '/api-generated.php';

$routes = [];
$paths = [app_path(implode(DIRECTORY_SEPARATOR, ['Http', 'Controllers']))];
foreach((new \Symfony\Component\Finder\Finder)->in($paths)->files() as $file) {
    $filename = str_replace('.php', '', $file->getFilename());
    $class= "\App\Http\Controllers\\{$filename}";

    $prefix = (string) \Str::of(str_replace('Controller', '', $filename))->kebab();
    
    $r = new \ReflectionClass($class);
    foreach ($r->getMethods() as $rmethod) {
        $method_name = $rmethod->getName();

        $ignore = [
            'middleware',
            'getMiddleware',
            'callAction',
            '__call',
            'authorize',
            'authorizeForUser',
            'parseAbilityAndArguments',
            'normalizeGuessedAbilityName',
            'authorizeResource',
            'resourceAbilityMap',
            'resourceMethodsWithoutModels',
            'dispatch',
            'dispatchNow',
            'validateWith',
            'validate',
            'validateWithBag',
            'getValidationFactory',
        ];

        if (in_array($method_name, $ignore)) continue;
        $route = [];
        $route['method'] = 'get';
        $route['route'] = [$prefix];
        $route['name'] = '';
        $route['class'] = $class;
        $route['call'] = ['Illuminate\Support\Facades\Route', 'get'];
        $route['callParams'] = [];

        $has_method = false;
        foreach(['any', 'get', 'post', 'put'] as $method) {
            if (\Str::startsWith($method_name, $method)) {
                $has_method = true;
                $route['route'][] = \Str::of(str_replace($method, '', $method_name))->studly()->kebab();
                $route['method'] = $method;
                $route['call'][1] = $method;
                break;
            }
        }

        if (! $has_method AND $method_name!='index') {
            $route['route'][] = \Str::of($method_name)->studly()->kebab();
        }

        $route['name'] = implode('.', $route['route']);

        foreach($rmethod->getParameters() as $param) {
            if (in_array($param->name, ['request'])) continue;
            $route['route'][] = '{'. $param->name .'}';
        }

        $route['route'] = implode('/', $route['route']);
        $route['callParams'][] = $route['route'];
        $route['callParams'][] = "{$class}@{$method_name}";

        $routes[] = $route;
        call_user_func_array($route['call'], $route['callParams']);
    }
}
