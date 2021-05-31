<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TevepInviteController extends Controller
{
	public function getSearch(Request $request) {
		return \App\Models\TevepInvite::with([
			'user',
		])
			->where(['deleted_at' => null])
			->querySearch();
	}

	public function getFind($id) {
		return \App\Models\TevepInvite::find($id);
	}

	public function postSave(Request $request) {
		return (new \App\Models\TevepInvite)->store($request->all());
	}

	public function postDelete($id) {
		return \App\Models\TevepInvite::find($id)->remove();
	}
}