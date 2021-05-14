<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TevepController extends Controller
{
	public function getSearch(Request $request) {
		return (new \App\Models\Tevep)->search($request->all());
	}

	public function getMe(Request $request) {
		return \App\Models\Tevep::myTeveps()
			->with(['user'])	
			->search($request->all());
	}

	public function getFind($id) {
		return \App\Models\Tevep::find($id);
	}

	public function postSave(Request $request) {
		$data = $request->all();
		$data['user_id'] = $data['user_id']? $data['user_id']: auth()->user()->id;
		return (new \App\Models\Tevep)->store($data);
	}

	public function postDelete($id) {
		return \App\Models\Tevep::find($id)->remove();
	}
}