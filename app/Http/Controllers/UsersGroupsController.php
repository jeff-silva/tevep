<?php

namespace App\Http\Controllers;

class UsersGroupsController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\UsersGroups;

		$this->middleware('auth:api', [
			'except' => ['search', 'find'],
		]);

		$this->defaultRoutes();
		$this->route('get', '/permissions', '@permissions');
	}


	public function permissions()
	{
		return collect(config('permissions.keys'))->map(function($name, $key) {
			return ['key' => $key, 'name' => $name];
		})->values();
	}
}
