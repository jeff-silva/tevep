<?php

namespace App\Http\Controllers;

class UsersController extends Controller
{
	public function boot()
	{
		$this->model = new \App\Models\Users;

		$this->middleware('auth:api', [
			'except' => [],
		]);

		$this->defaultRoutes([
			'except' => ['delete', 'restore', 'clone'],
		]);
	}


	public function onLoad($data)
	{
		$data['user'] = false;
		$data['userPermissions'] = [];
		$data['userSettings'] = [];

		if ($user = auth()->user()) {
			$data['user'] = $user;
			$data['userSettings'] = $user->settings;
			if ($group = \App\Models\UsersGroups::select(['permissions'])->find($user->group_id)) {
				$data['userPermissions'] = $group->permissions;
			}
		}

		return $data;
	}


	public function onDashboard($data)
	{
		$data['usersTotal'] = \App\Models\Users::select(['id'])->count();
		return $data;
	}

	
	public function save()
    {
		$data = request()->all();
		if (isset($data['password']) AND empty($data['password'])) {
			unset($data['password']);
		}
        return $this->model->updateOrCreate(['id' => request('id')], $data);
    }


	public function find($id)
	{
		if ('me'==$id AND $user = auth()->user()) {
            $id = $user->id;
        }
		return parent::find($id);
	}
}
