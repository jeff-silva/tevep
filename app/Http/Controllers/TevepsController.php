<?php

namespace App\Http\Controllers;

class TevepsController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Teveps;

		$this->middleware('auth:api', [
			'except' => ['search', 'find'],
		]);

		// Generate default routes (search, find, save, delete, etc...)
		$this->defaultRoutes();

		// Custom route example: POST /api/teveps/test/123
		// $this->route('post', '/test/{id}', '@test');
	}
}
