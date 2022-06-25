<?php

namespace App\Http\Controllers;

class TevepsInvitesController extends Controller
{
	public function boot()
	{
		$this->model = new \App\Models\TevepsInvites;

		$this->middleware('auth:api', [
			'except' => [],
		]);

		// Generate default routes (search, find, save, delete, etc...)
		$this->defaultRoutes();

		// Custom route example: POST /api/teveps-invites/test/123
		// $this->route('post', '/test/{id}', '@test');
	}
}
