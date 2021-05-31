<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Buscar Configurações
     * 
     * Parâmetros aceitos:
     * search: Termo de busca
     * page: Página
     * orderby: Nome da coluna de parâmetro para ordenação
     * order: asc ou desc
     */
    public function search(Request $request) {
        return (new \App\Models\Setting)->search($request->all());
    }

    /**
     * Retornar Configuração por id
     */
    public function find($id) {
        return \App\Models\Setting::find($id);
    }

    /**
     * Salvar dados de Configuração
     */
    public function save(Request $request) {
        // return (new \App\Models\Setting)->store($request->all());
        return (new \App\Models\Setting)->saveAll($request->all());
    }

    /**
     * Deletar Configuração
     */
    public function delete($id) {
        return \App\Models\Setting::find($id)->remove();
    }

    /**
     * Teste de configuração de email
     */
    public function emailTest($request) {
        return \App\Models\Email::send($request->input('email'), 'E-mail de teste', $request->input('body'));
    }

    /**
     * Todas as configurações
     */
    public function all() {
        $data = [];

        foreach(\App\Models\Setting::all() as $setting) {
            $data[ $setting->name ] = $setting;
        }

        return $data;
    }

	public function getSearch() {
		return \App\Models\Setting::querySearch();
	}

	public function getFind($id) {
		return \App\Models\Setting::find($id);
	}

	public function postSave() {
		return (new \App\Models\Setting)->store(request()->all());
	}

	public function postDelete($id) {
		return \App\Models\Setting::find($id)->remove();
	}
}