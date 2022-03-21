<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Settings;

		$this->middleware('auth:api', [
			'except' => ['test'],
		]);

		// $this->route('get', '/test', '@test');
		$this->route('get', '/endpoints', '@endpoints');
		$this->route('get', '/dashboard', '@dashboard');
	}


	public function test()
	{
		return collect(config('permissions.keys'))->map(function($name, $key) {
			return ['key' => $key, 'name' => $name];
		})->values();
	}

	
	public function endpoints()
	{
		$routes = [];

		foreach(\Route::getRoutes() as $item) {
			$route = (object) [
				'uri' => $item->uri(),
				'methods' => $item->methods(),
				'parameterNames' => $item->parameterNames(),
				'name' => $item->getName(),
			];

			if ($route->uri=='{path}') continue;
			if (\Str::startsWith($route->uri, '_ignition')) continue;
			if (\Str::startsWith($route->uri, 'sanctum')) continue;

			$routes[] = $route;
		}

		return $routes;
	}


	public function dashboard()
	{
		$return['users'] = \App\Models\User::select(['id'])->count();
		$return['filesSize'] = \App\Models\Files::select(['size'])->get()->sum('size');
		return $return;
	}


	public function search()
	{
		$return = [];

		$return[] = [
			'name' => 'Usuários',
			'items' => (new \App\Models\User)->select(['id', 'name'])->search()->get()->transform(function($item) {
				return ['name' => $item->name, 'url' => "/admin/user/{$item->id}"];
			}),
		];

		$return[] = [
			'name' => 'Grupos de usuários',
			'items' => (new \App\Models\UsersGroups)->select(['id', 'name'])->search()->get()->transform(function($item) {
				return ['name' => $item->name, 'url' => "/admin/users-groups/{$item->id}"];
			}),
		];

		$return[] = [
			'name' => 'Arquivos',
			'items' => (new \App\Models\Files)->select(['id', 'name'])->search()->get()->transform(function($item) {
				return ['name' => $item->name, 'url' => "/admin/files/{$item->id}"];
			}),
		];
		
		$return[] = [
			'name' => 'Páginas',
			'items' => (new \App\Models\Pages)->select(['id', 'name'])->search()->get()->transform(function($item) {
				return ['name' => $item->name, 'url' => "/admin/pages/{$item->id}"];
			}),
		];

		$return[] = [
			'name' => 'Life Events',
			'items' => (new \App\Models\LifeEvents)->select(['id', 'name'])->search()->get()->transform(function($item) {
				return ['name' => $item->name, 'url' => "/admin/life-events/{$item->id}"];
			}),
		];

		$return[] = [
			'name' => 'Life Worlds',
			'items' => (new \App\Models\LifeEvents)->select(['id', 'name'])->search()->get()->transform(function($item) {
				return ['name' => $item->name, 'url' => "/admin/life-worlds/{$item->id}"];
			}),
		];

		$return[] = [
			'name' => 'Life Pessoas',
			'items' => (new \App\Models\LifePersons)->select(['id', 'name'])->search()->get()->transform(function($item) {
				return ['name' => $item->name, 'url' => "/admin/life-persons/{$item->id}"];
			}),
		];

		$return[] = [
			'name' => 'Life Interações',
			'items' => (new \App\Models\LifePersonsInteractions)->select(['id', 'name'])->search()->get()->transform(function($item) {
				return ['name' => $item->name, 'url' => "/admin/life-persons-interactions/{$item->id}"];
			}),
		];

		return $return;
	}


	public function mailTest() {
		$params = array_merge([
			'to' => '',
			'subject' => '',
			'body' => '',
		], request()->all());

		\Mail::send([], [], function($message) use ($params) {
            $message->to($params['to']);
			$message->subject($params['subject']);
			$message->setBody($params['body'], 'text/html');
        });

		return [
			'failures' => \Mail::failures(),
		];
	}
}
