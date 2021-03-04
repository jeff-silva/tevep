<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailSentController extends Controller
{
    
    /**
     * Buscar Emails enviados
     * 
     * Parâmetros aceitos:
     * search: Termo de busca
     * page: Página
     * orderby: Nome da coluna de parâmetro para ordenação
     * order: asc ou desc
     */
    public function search(Request $request) {
        return (new \App\Models\EmailSent)->search($request->all());
    }

    /**
     * Retornar Email enviado por id
     */
    public function find($id) {
        return \App\Models\EmailSent::find($id);
    }

    /**
     * Salvar dados de Email enviado
     */
    public function save(Request $request) {
        return (new \App\Models\EmailSent)->fill($request->all())->store();
    }

    /**
     * Deletar Email enviado
     */
    public function delete($id) {
        return [$id];
    }
}