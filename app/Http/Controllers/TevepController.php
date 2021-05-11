<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TevepController extends Controller
{
	public function getSearch(Request $request) {
		return (new \App\Models\Tevep)->search($request->all());
	}

	public function me(Request $request) {
		if ($user = \Illuminate\Support\Facades\Auth::user()) {
			return \App\Models\Tevep::where([
				'user_id' => $user->id,
			])->search($request->all());
		}

		return [];
	}

	public function getFind($id) {
		return \App\Models\Tevep::find($id);
	}

	public function postSave(Request $request) {
		return (new \App\Models\Tevep)->store($request->all());
	}

	public function postDelete($id) {
		return \App\Models\Tevep::find($id)->remove();
	}
}