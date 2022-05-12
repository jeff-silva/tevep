<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Settings;

		$this->middleware('auth:api', [
			'except' => ['load', 'endpoints', 'test', 'script', 'info'],
		]);

		$this->route('post', '/load', 'load', [
			'description' => 'Informações e variáveis do sistema',
		]);
		
		$this->route('get', '/search', 'search', [
			'description' => 'Busca geral do sistema',
		]);
		
		$this->route('get', '/endpoints', 'endpoints', [
			'description' => 'Lista de endpoints do sistema',
		]);

		$this->route('get', '/dashboard', 'dashboard', [
			'description' => 'Dados do dashboard',
		]);
		
		$this->route('post', '/mail-test', 'mailTest', [
			'description' => 'Teste de envio de e-mail',
		]);
	}


	public function load()
	{
		$load = [];

		$load['devMode'] = !\App::environment('production');
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
				['to'=>'/admin/users-groups', 'icon'=>'mdi-account', 'label'=>'Grupos de usuários', 'children'=>[]],
			]],
			['to'=>'', 'icon'=>'mdi-cog', 'label'=>'Configurações', 'children'=>[
				['to'=>'/admin/settings', 'icon'=>'mdi-cog', 'label'=>'Configurações', 'children'=>[]],
				['to'=>'/admin/files', 'icon'=>'mdi-cog', 'label'=>'Arquivos', 'children'=>[]],
				['to'=>'/admin/places', 'icon'=>'mdi-cog', 'label'=>'Endereços', 'children'=>[]],
			]],
		];

		return $load;
	}


	public function search()
	{
		$q = request('q', '');
		$return = [];

		$models = array_map('realpath', glob(base_path("/app/Models/*")));
		$models = array_map(function($model) {
			$model = str_replace(base_path(), '', $model);
			$model = str_replace('\\app', '\App', $model);
			$model = str_replace('.php', '', $model);
			return app($model);
		}, $models);

		foreach($models as $model) {
			if (!$model->plural) continue;

			$namespace = \Str::of($model->getTable())->studly()->kebab();
			$items = $model->select(['id', 'name'])->search(['q' => $q])->limit(10)->get()->transform(function($item) use($namespace) {
				$item->url = "/admin/{$namespace}?id={$item->id}";
				return $item;
			});
			if (sizeof($items)==0) continue;
			$return[] = [
				'name' => $model->plural,
				'url' => "/admin/{$namespace}",
				'data' => $items,
			];
		}

		return $return;
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
		$return['users'] = \App\Models\Users::select(['id'])->count();
		$return['filesSize'] = \App\Models\Files::select(['size'])->get()->sum('size');
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
