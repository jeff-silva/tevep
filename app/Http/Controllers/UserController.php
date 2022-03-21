<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\User;

		$this->middleware('auth:api', [
			'except' => ['search', 'find'],
		]);

		$this->defaultRoutes([
			'except' => ['delete', 'restore', 'clone'],
		]);
	}

	// public function search()
    // {
    //     return $this->model->search()->with(['photo'])->paginate(request('per_page', 15));
    // }
}
