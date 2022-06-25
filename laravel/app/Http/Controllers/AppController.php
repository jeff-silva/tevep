<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
	public function boot()
	{
		// $this->model = new \App\Models\Settings;

		$this->middleware('auth:api', [
			'except' => ['load', 'swagger', 'test', 'script', 'info'],
		]);

		$this->route('post', '/load', 'load', [
			'description' => 'Informações e variáveis do sistema',
		]);
		
		$this->route('get', '/search', 'search', [
			'description' => 'Busca geral do sistema',
		]);
		
		$this->route('get', '/swagger', 'swagger', [
			'description' => 'Dados swagger',
		]);

		$this->route('get', '/dashboard', 'dashboard', [
			'description' => 'Dados do dashboard',
		]);
		
		$this->route('post', '/mail-test', 'mailTest', [
			'description' => 'Teste de envio de e-mail',
		]);
		
		$this->route('get', '/test', 'test', [
			'description' => 'Teste',
		]);
	}


	/**
	 * Configurações iniciais da aplicação
	 */
	public function load()
	{
		$load = [];

		$load['devMode'] = !\App::environment('production');

		$load['settings'] = \App\Models\Settings::getAll(false);
		$load['translations'] = [];
		$load['adminNav'] = [
			['to'=>'/admin', 'icon'=>'mdi-view-dashboard', 'label'=>'Dashboard', 'children'=>[]],
			['to'=>'', 'icon'=>'mdi-database', 'label'=>'Tevep', 'children'=>[
				['to'=>'/admin/teveps', 'icon'=>'mdi-database', 'label'=>'Procurar', 'children'=>[]],
				['to'=>'/admin/teveps?id=new', 'icon'=>'mdi-database', 'label'=>'Criar', 'children'=>[]],
			]],
			['to'=>'', 'icon'=>'mdi-sitemap', 'label'=>'Conteúdo', 'children'=>[
				['to'=>'/admin/pages', 'icon'=>'mdi-sitemap', 'label'=>'Páginas', 'children'=>[]],
				['to'=>'/admin/pages-elements', 'icon'=>'mdi-sitemap', 'label'=>'Elementos', 'children'=>[]],
			]],
			['to'=>'', 'icon'=>'mdi-account', 'label'=>'Acessos', 'children'=>[
				['to'=>'/admin/users', 'icon'=>'mdi-account', 'label'=>'Usuários', 'children'=>[]],
				['to'=>'/admin/users-groups', 'icon'=>'mdi-account', 'label'=>'Grupos de usuários', 'children'=>[]],
			]],
			['to'=>'', 'icon'=>'mdi-cog', 'label'=>'Configurações', 'children'=>[
				['to'=>'/admin/settings', 'icon'=>'mdi-cog', 'label'=>'Configurações', 'children'=>[]],
				['to'=>'/admin/emails-templates', 'icon'=>'mdi-cog', 'label'=>'Templates de e-mail', 'children'=>[]],
				['to'=>'/admin/files', 'icon'=>'mdi-cog', 'label'=>'Arquivos', 'children'=>[]],
				['to'=>'/admin/places', 'icon'=>'mdi-cog', 'label'=>'Endereços', 'children'=>[]],
			]],
		];

		foreach(event('/api/app/load', [ $load ]) as $value) {
			$load = array_merge($load, $value);
		}

		return $load;
	}


	/**
	 * Pesquisa global em todos os models da aplicação
	 */
	public function search()
	{
		$q = request('q', '');
		$return = [];

		foreach(\App\Utils::getModels() as $model) {
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
		$serviceAccount = json_decode(\App\Models\Settings::getValue('google.account_json'), true);

		$client = new \Google_Client();
		$client->setApplicationName(config('app.name'));
		$client->setAuthConfig($serviceAccount);
		$client->setAccessType('offline');
		$client->setScopes([
			'https://www.googleapis.com/auth/analytics.readonly',
			'https://www.googleapis.com/auth/youtube',
		]);

		$access_token = \App\Models\Settings::getValue('google.access_token', function() use($client, $serviceAccount) {
			$client->refreshTokenWithAssertion();
			$token = $client->getAccessToken();
			\App\Models\Settings::setValue('google.access_token', $token['access_token']);
			return $token['access_token'];
		});

		$client->setAccessToken($access_token);

		// Analytics
		call_user_func(function() use($client) {
			return;
			$analytics = new \Google_Service_Analytics($client);
			$accounts = $analytics->management_accounts->listManagementAccounts();
			dd($accounts);
		});


		// Firebase
		call_user_func(function() use($client) {
			return;
			$service = new \Google_Service_FirebaseRealtimeDatabase($client);
			dd($service);
		});


		// Free books
		call_user_func(function() use($client) {
			return;
			$service = new \Google_Service_Books($client);
			$results = $service->volumes->listVolumes('Henry David Thoreau', [
				'filter' => 'free-ebooks',
			]);
			dd($results->getItems());
		});


		// Youtube
		call_user_func(function() use($client) {
			return;
			$youtube = new \Google_Service_Youtube($client);
			$searchResponse = $youtube->search->listSearch('id,snippet', [
				'q' => 'gorillaz',
				'maxResults' => 10,
			]);
			dd($searchResponse);
		});
	}


	/**
	 * JSON swagger
	 */
	public function swagger()
	{
		return \App\Utils::swagger();
	}

	
	/**
	 * Dados do dashboard
	 */
	public function dashboard()
	{
		$return = [];

		foreach(event('/api/app/dashboard', [ $return ]) as $value) {
			$return = array_merge($return, $value);
		}

		return $return;
	}


	public function mailTest() {
		$params = array_merge([
			'to' => '',
			'subject' => '',
			'body' => '',
		], request()->all());

		// dd(config('mail'));

		// \Mail::send([], [], function($message) use ($params) {
		// 	$message->from('laravel@grr.la');
		// 	$message->to($params['to']);
		// 	$message->subject($params['subject']);
		// 	$message->setBody($params['body'], 'text/html');
		// });
		
		\Mail::send([], [], function($message) use ($params) {
			$message->from('laravel@grr.la');
			$message->to($params['to']);
			$message->subject($params['subject']);
			$message->setBody($params['body'], 'text/html');
			dd($params, $message);
		});
		
		// \Mail::raw([], function($message) use ($params) {
		// 	$message->to($params['to']);
		// 	$message->subject($params['subject']);
		// 	$message->setBody($params['body'], 'text/html');
		// });

		return [
			'failures' => \Mail::failures(),
		];
	}
}
