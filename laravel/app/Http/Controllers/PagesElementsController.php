<?php

namespace App\Http\Controllers;

class PagesElementsController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\PagesElements;

		$this->middleware('auth:api', [
			'except' => ['search', 'find'],
		]);

		// Generate default routes (search, find, save, delete, etc...)
		$this->defaultRoutes();

		// Custom route example: POST /api/pages-elements/test/123
		// $this->route('post', '/test/{id}', '@test');
	}
}
