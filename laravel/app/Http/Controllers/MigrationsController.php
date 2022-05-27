<?php

namespace App\Http\Controllers;

class MigrationsController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Migrations;

		$this->middleware('auth:api', [
			'except' => [],
		]);

		$this->defaultRoutes();
	}
}
