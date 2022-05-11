<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Settings;

		$this->middleware('auth:api', [
			'except' => ['test', 'script', 'info', 'load'],
		]);

		$this->route('post', '/load', 'load', [
			'description' => 'Informações e variáveis do sistema',
		]);

		$this->route('get', '/dashboard', 'dashboard', [
			'description' => 'Dados do dashboard',
		]);
		
		$this->route('post', '/mail-test', 'mailTest', [
			'description' => 'Teste de envio de e-mail',
		]);
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

	public function script()
	{
		$env = [
			'aaa' => true,
		];

		$lines[] = 'console.log(window.$nuxt);';
		// $lines[] = 'window.$nuxt.$settings = '. json_encode($env) .';';

		return response(implode("\n", $lines), 200)->header('Content-Type', 'application/javascript');
	}


	public function load()
	{
		$load = [];

		$load['user'] = false;
		$load['userPermissions'] = [];
		if ($user = auth()->user()) {
			$load['user'] = $user;
			if ($group = \App\Models\UsersGroups::select(['permissions'])->find($user->group_id)) {
				$load['userPermissions'] = $group->permissions;
			}
		}

		$load['settings'] = \App\Models\Settings::getAll(false);
		$load['translations'] = [];
		$load['adminNav'] = [
			['to'=>'/admin', 'icon'=>'mdi-view-dashboard', 'label'=>'Dashboard', 'children'=>[]],
			['to'=>'', 'icon'=>'mdi-database', 'label'=>'Tevep', 'children'=>[
				['to'=>'/admin/teveps', 'icon'=>'mdi-database', 'label'=>'Procurar', 'children'=>[]],
				['to'=>'/admin/teveps?id=new', 'icon'=>'mdi-database', 'label'=>'Criar', 'children'=>[]],
			]],
			['to'=>'', 'icon'=>'mdi-sitemap', 'label'=>'Páginas', 'children'=>[
				['to'=>'/admin/pages', 'icon'=>'mdi-sitemap', 'label'=>'Procurar', 'children'=>[]],
				['to'=>'/admin/pages?id=new', 'icon'=>'mdi-sitemap', 'label'=>'Criar', 'children'=>[]],
				['to'=>'/admin/pages-elements', 'icon'=>'mdi-sitemap', 'label'=>'Elementos', 'children'=>[]],
			]],
			['to'=>'', 'icon'=>'mdi-account', 'label'=>'Usuários', 'children'=>[
				['to'=>'/admin/users', 'icon'=>'mdi-account', 'label'=>'Procurar', 'children'=>[]],
				['to'=>'/admin/users?id=new', 'icon'=>'mdi-account', 'label'=>'Criar', 'children'=>[]],
			]],
			['to'=>'', 'icon'=>'mdi-cog', 'label'=>'Configurações', 'children'=>[
				['to'=>'/admin/settings', 'icon'=>'mdi-cog', 'label'=>'Configurações', 'children'=>[]],
				['to'=>'/admin/files', 'icon'=>'mdi-cog', 'label'=>'Arquivos', 'children'=>[]],
				['to'=>'/admin/places', 'icon'=>'mdi-cog', 'label'=>'Endereços', 'children'=>[]],
			]],
		];

		return $load;
	}
	
	public function dashboard()
	{
		$return['users'] = \App\Models\Users::select(['id'])->count();
		$return['filesSize'] = \App\Models\Files::select(['size'])->get()->sum('size');
		return $return;
	}


	public function search()
	{
		// TODO: fazer loop em todas as models utilizando $model->search(['q' => 'busca'])->limit(10)->get();
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
