<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Settings;

		$this->middleware('auth:api', [
			'except' => ['search'],
		]);

		$this->defaultRoutes([
			'except' => ['search', 'find', 'save', 'valid', 'delete', 'restore', 'clone'],
		]);

		$this->route('post', '/save', 'saveAll');
		$this->route('get', '/all', 'getAll');
	}

	public function saveAll() {
		return \App\Models\Settings::saveAll(request()->all());
	}

	public function getAll() {
		return \App\Models\Settings::getAll(true);
	}
}
