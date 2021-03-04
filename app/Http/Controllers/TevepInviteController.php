<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TevepInviteController extends Controller
{
    
    /**
     * Buscar Convites
     * 
     * Parâmetros aceitos:
     * search: Termo de busca
     * page: Página
     * orderby: Nome da coluna de parâmetro para ordenação
     * order: asc ou desc
     */
    public function search(Request $request) {
        return (new \App\Models\TevepInvite)->search($request->all());
    }

    /**
     * Retornar Convite por id
     */
    public function find($id) {
        return \App\Models\TevepInvite::find($id);
    }

    /**
     * Salvar dados de Convite
     */
    public function save(Request $request) {
        return (new \App\Models\TevepInvite)->fill($request->all())->store();
    }

    /**
     * Deletar Convite
     */
    public function delete($id) {
        return \App\Models\TevepInvite::find($id)->remove();
    }
}