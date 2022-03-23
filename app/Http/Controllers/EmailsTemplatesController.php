<?php

namespace App\Http\Controllers;

class EmailsTemplatesController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\EmailsTemplates;

		$this->middleware('auth:api', [
			// 'except' => [],
		]);

		// Generate default routes (search, find, save, delete, etc...)
		$this->defaultRoutes([
			'except' => ['delete', 'restore', 'clone'],
		]);

		// Custom route example: POST /api/emails-templates/test/123
		$this->route('post', '/test/{id}', 'test');
	}


	public function test($id)
	{
		return [ $id ];
	}
}
