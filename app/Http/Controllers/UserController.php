<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register() {
        $all = request()->all();
        return (new \App\User)->fill($all)->store();
    }
}
