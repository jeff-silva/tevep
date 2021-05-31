<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
	public function getSearch() {
		return \App\Models\Email::querySearch();
	}

	public function getFind($id) {
		return \App\Models\Email::find($id);
	}

	public function postSave() {
		return (new \App\Models\Email)->store(request()->all());
	}

	public function postDelete($id) {
		return \App\Models\Email::find($id)->remove();
	}

    public function postTest() {
		// return \App\Models\Email::find($id)->remove();
        return ['?'];
	}
}