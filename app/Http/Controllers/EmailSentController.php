<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailSentController extends Controller
{
	public function getSearch() {
		return \App\Models\EmailSent::querySearch();
	}

	public function getFind($id) {
		return \App\Models\EmailSent::find($id);
	}

	public function postSave() {
		return (new \App\Models\EmailSent)->store(request()->all());
	}

	public function postDelete($id) {
		return \App\Models\EmailSent::find($id)->remove();
	}
}