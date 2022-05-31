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

	
	public function save()
    {
		$data = request()->all();
		if (isset($data['password']) AND empty($data['password'])) {
			unset($data['password']);
		}
        return $this->model->updateOrCreate(['id' => request('id')], $data);
    }
}
