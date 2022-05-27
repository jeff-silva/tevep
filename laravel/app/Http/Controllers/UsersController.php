<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->model = new \App\Models\Users;

		$this->middleware('auth:api', [
			'except' => [],
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
