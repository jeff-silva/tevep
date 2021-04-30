<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TevepController extends Controller
{
	public function getSearch(Request $request) {
		return (new \App\Models\Tevep)->search($request->all());
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