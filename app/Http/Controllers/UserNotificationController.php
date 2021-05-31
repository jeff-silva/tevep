<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
	public function getSearch(Request $request) {
		return (new \App\Models\UserNotification)->querySearch();
	}

	public function getFind($id) {
		return \App\Models\UserNotification::find($id);
	}

	public function postSave(Request $request) {
		return (new \App\Models\UserNotification)->store($request->all());
	}

	public function postDelete($id) {
		return \App\Models\UserNotification::find($id)->remove();
	}
}