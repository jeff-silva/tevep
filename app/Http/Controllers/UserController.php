<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    /**
     * Buscar Usuários
     * 
     * Parâmetros aceitos:
     * search: Termo de busca
     * page: Página
     * orderby: Nome da coluna de parâmetro para ordenação
     * order: asc ou desc
     */
    public function search(Request $request) {
        return (new \App\Models\User)->search($request->all());
    }

    /**
     * Retornar Usuário por id
     */
    public function find($id) {
        return \App\Models\User::find($id);
    }

    /**
     * Salvar dados de Usuário
     */
    public function save(Request $request) {
        return (new \App\Models\User)->store($request->all());
    }

    /**
     * Deletar Usuário
     */
    public function delete($id) {
        return \App\Models\User::find($id)->remove();
    }
}