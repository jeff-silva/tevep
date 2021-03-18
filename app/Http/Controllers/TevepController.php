<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TevepController extends Controller
{
    
    /**
     * Buscar Teveps
     * 
     * Parâmetros aceitos:
     * search: Termo de busca
     * page: Página
     * orderby: Nome da coluna de parâmetro para ordenação
     * order: asc ou desc
     */
    public function search(Request $request) {
        return (new \App\Models\Tevep)->search($request->all());
    }

    /**
     * Retornar Tevep por id
     */
    public function find($id) {
        return \App\Models\Tevep::find($id);
    }

    /**
     * Salvar dados de Tevep
     */
    public function save(Request $request) {
        return (new \App\Models\Tevep)->store($request->all());
    }

    /**
     * Deletar Tevep
     */
    public function delete($id) {
        return \App\Models\Tevep::find($id)->remove();
    }
}