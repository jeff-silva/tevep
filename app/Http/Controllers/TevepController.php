<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TevepController extends Controller
{
	public function getSearch(Request $request) {
		$query = \App\Models\Tevep::with(['user']);

		if ($request->input('my')) {
			$query = $query->myTeveps();
		}

		return $query->querySearch();
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