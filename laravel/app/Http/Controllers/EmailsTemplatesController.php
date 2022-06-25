<?php

namespace App\Http\Controllers;

class EmailsTemplatesController extends Controller
{
	public function boot()
	{
		$this->model = new \App\Models\EmailsTemplates;

		$this->middleware('auth:api', [
			// 'except' => [],
		]);

		// Generate default routes (search, find, save, delete, etc...)
		$this->defaultRoutes([
			'except' => ['delete', 'restore', 'clone'],
		]);

		$this->route('post', '/test', 'test', [
			'description' => 'Testar template de e-mail',
			'body' => ['id' => '', 'email' => ''],
		]);
	}


	public function test()
	{
		if ($template = \App\Models\EmailsTemplates::find(request('id'))) {
			return $template->test()->sendTo(request('email'));
		}
		
		return false;
	}
}
