<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
	public function getSearch() {
		return \App\Models\Setting::querySearch();
	}

	public function getFind($id) {
		return \App\Models\Setting::find($id);
	}

	public function postSave() {
		return (new \App\Models\Setting)->saveAll(request()->all());
	}

	public function postDelete($id) {
		return \App\Models\Setting::find($id)->remove();
	}

    public function getAll() {
        return (new \App\Models\Setting)->getAll();
    }
}