<?php

namespace App\Http\Controllers;

class PlacesController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Places;

		$this->middleware('auth:api', [
			'except' => [],
		]);

		// Generate default routes (search, find, save, delete, etc...)
		$this->defaultRoutes();

		$this->route('get', '/place-search', 'placeSearch');

		// Custom route example: POST /api/places/test/123
		// $this->route('post', '/test/{id}', '@test');
	}

	public function placeSearch()
	{
		return $this->model->placeSearch([
			'search' => request('search', ''),
		]);
	}
}
