<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
	public function boot()
	{
		$this->model = new \App\Models\Pages;

		$this->middleware('auth:api', [
			'except' => ['search', 'find'],
		]);

		$this->defaultRoutes();
	}
}
