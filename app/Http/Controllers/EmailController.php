<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    
    /**
     * Buscar E-mails
     * 
     * Parâmetros aceitos:
     * search: Termo de busca
     * page: Página
     * orderby: Nome da coluna de parâmetro para ordenação
     * order: asc ou desc
     */
    public function search(Request $request) {
        return (new \App\Models\Email)->search($request->all());
    }

    /**
     * Retornar E-mail por id
     */
    public function find($id) {
        return \App\Models\Email::find($id);
    }

    /**
     * Salvar dados de E-mail
     */
    public function save(Request $request) {
        return (new \App\Models\Email)->fill($request->all())->store();
    }

    /**
     * Deletar E-mail
     */
    public function delete($id) {
        return [$id];
    }

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
}