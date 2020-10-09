<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TevepController extends Controller
{
    public function find(Request $request)
    {
        $tevep = \App\Tevep::find($request->input('id'));
        return $tevep? $tevep: ['error'=>'Projeto não encontrado'];
    }


    public function search(Request $request)
    {
        return (new \App\Tevep())->search($request->all());
    }


    public function save(Request $request)
    {
        return (new \App\Tevep($request->all()))->store();
    }


    public function delete(Request $request)
    {
        return $request;
    }
}
